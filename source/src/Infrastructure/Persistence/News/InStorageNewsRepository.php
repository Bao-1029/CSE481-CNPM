<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\News\News;
use App\Domain\News\NewsNotFoundException;
use App\Domain\News\NewsRepository;
use App\Utils\Ncov\CrawlGoogleNews;
use App\Utils\DateTime as DT;
use DateTime;
use Psr\Container\ContainerInterface;
use Exception;
use OutOfRangeException;
use WriteiniFile\WriteiniFile;

class InStorageNewsRepository extends NewsRepositoryService implements NewsRepository {
    /**
     * @var News[]
     */
    private $newsList;
    private $parser;
    private $totalNumNews;
    private static $config;

    public function __construct(ContainerInterface $c) {
        static::$config = $c->get('storage');
        $this->totalNumNews = static::$config['total']['num'];
        // Check time to Crawl data again
        $now = DT::getNow();
        $oldTime = DateTime::createFromFormat('U', static::$config['reloadTime']['last_reload_at']);
        $oldTime = $oldTime->modify('+' . static::$config['reloadTime']['limit'])->format('U');
        if ($oldTime < $now)
        {
            $this->newsList = new CrawlGoogleNews();
            $this->insertCrawlData();
            $this->totalNumNews = $this->getTotalNumberOfNews();
            // Update data in config file
            $file = new WriteiniFile(static::$config);
            $file->update([
                    'reloadTime' => ['last_reload_at' => DT::getNow()]
                ])->update([
                    'total' => ['num' => $this->totalNumNews]
                ])->write();
        }
    }
   
    /**
     * {@inheritdoc}
     */
    public function getNews(): array
    {
        try {
            $headlines = $this->getHeadlines();
            $newsList = $this->getNewsByPagiation(1);
            return array_merge($headlines, ['news' => $newsList]);
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
            return $this->selectNews(0, static::$config['headLines']['limit']);
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
            $offset = ($this->totalNumNews - static::$config['headLines']['limit']) - static::$config['newsPagination']['limit'];
            return $this->selectNews($offset, static::$config['newsPagination']['limit']);
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
            $lastTitle = $this->getLatestTitleNews();
            foreach ($this->newsList as $key => $value) {
                if ($value->title != $lastTitle)
                    if (!$this->insertNews(
                        $value->title,
                        $value->link,
                        $value->source,
                        $value->imgUri
                    ))
                        break;
                    else
                        break;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
?>