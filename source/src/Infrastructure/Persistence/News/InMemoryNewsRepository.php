<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\News\News;
use App\Domain\News\NewsNotFoundException;
use App\Domain\News\NewsRepository;
use App\Utils\Ncov\CrawlGoogleNews;
use PDO;
use DateTime;
use DateTimeZone;
use Psr\Container\ContainerInterface;
use Exception;
use OutOfRangeException;
use WriteiniFile\ReadiniFile;
use WriteiniFile\WriteiniFile;

class InMemoryNewsRepository implements NewsRepository {
    /**
     * @var News[]
     */
    private $newsList;
    private $service;
    private $totalNumNews;
    private static $config;

    public function __construct(ContainerInterface $c, PDO $pdo) {
        $this->service = new NewsRepositoryService($pdo, $c->get('database')['dbname']);

        $pathIni = $c->get('storage')['config'];
        static::$config = ReadiniFile::get($pathIni);
        $this->totalNumNews = static::$config['total']['num'];
        // Check time to Crawl data again
        $now = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $oldTime = new DateTime(static::$config['reloadTime']['last_reload_at'], new DateTimeZone('Asia/Ho_Chi_Minh'));
        if ($oldTime < $now)
        {
            $crawler = new CrawlGoogleNews();
            $this->newsList = $crawler->result;
            $this->insertCrawlData();
            $this->totalNumNews = $this->service->getTotalNumberOfNews();
            // Update data in config file
            $now = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
            $file = new WriteiniFile($pathIni);
            $file->update([
                    'reloadTime' => ['last_reload_at' => $now->format('Y-m-d H:i:s')]
                ])->update([
                    'total' => ['num' => $this->totalNumNews]
                ])->write();

            unset($crawler);
        }

        unset($pathIni);
    }
   
    /**
     * {@inheritdoc}
     */
    public function getNews(): array
    {
        try {
            $headlines = $this->getHeadlines();
            $newsList = $this->getNewsByPagiation(1);
            return array_merge(['headlines' => $headlines], ['news' => $newsList]);
        } catch (Exception $e) {
            throw new NewsNotFoundException("Error Processing Request", 1);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeadlines(): array
    {
        try {
            return $this->service->selectWithCond(0, (int) static::$config['headLines']['limit']);
        } catch (Exception $e) {
            throw new NewsNotFoundException("Error Processing Request", 1);
        }
        
        /* 
         * Using database, not just a data file one anymore
        
        $n = array_slice($this->newsList, -4);
        $last = array_pop($n);
        return array(
            'headlines' => $last,
            'others' => $n
        ); */
    }

    /**
     * {@inheritdoc}
     */
    public function getNewsByPagiation(int $num): array
    {
        try {
            $offset = ($this->totalNumNews - static::$config['headLines']['limit']) - (static::$config['newsPagination']['limit'] * $num);
            if ($offset <= 0)
                return [];
            return $this->service->selectWithCond((int) $offset, (int) static::$config['newsPagination']['limit']);
        } catch (OutOfRangeException $e) {
            throw new NewsNotFoundException("Not Found!", 1);
        }
        catch (Exception $e) {
            throw new NewsNotFoundException("Error Processing Request", 1);
        }
        
        /* 
         * Using database, not just a data file one anymore
        
        $offset = (count($this->newsList) - 4) - 6;
        return array_slice($this->newsList, $offset, 6); */
    }

    private function insertCrawlData()
    {
        try {
            $lastTitle = $this->service->getLatestTitleNews();
            foreach ($this->newsList as $key => $value) {
                if ($value['title'] != $lastTitle)
                    $this->service->insertNews(
                        $value['title'],
                        $value['link'],
                        $value['source'],
                        $value['imgUri']
                    );
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
?>