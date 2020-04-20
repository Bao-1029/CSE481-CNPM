<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\News\News;
use App\Domain\News\NewsNotFoundException;
use App\Domain\News\NewsRepository;
use App\Utils\Ncov\CrawlGgNews;
use App\Utils\DateTime as DT;
use DateTime;
use Exception;
use OutOfRangeException;
use WriteiniFile\WriteiniFile;

define('PATH', $GLOBALS['storage']['news_path']);
define('CONFIG', parse_ini_file(realpath($GLOBALS['storage']['config'])));

class InStorageNewsRepository extends NewsRepositoryService implements NewsRepository {
    /**
     * @var News[]
     */
    private $newsList;
    private $parser;
    private $totalNumNews;
    private const PATH = PATH;
    private const CONFIG = CONFIG;

    public function __construct() {
        $this->totalNumNews = self::CONFIG['total']['num'];
        // Check time to Crawl data again
        $now = DT::getNow();
        $oldTime = DateTime::createFromFormat('U', self::CONFIG['reloadTime']['last_reload_at']);
        $oldTime = $oldTime->modify('+' . self::CONFIG['reloadTime']['limit'])->format('U');
        if ($oldTime < $now)
        {
            $this->newsList = new CrawlGgNews();
            $this->insertCrawlData();
            $this->totalNumNews = $this->getTotalNumberOfNews();
            // Update data in config file
            $file = new WriteiniFile(self::CONFIG);
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
            return $this->selectNews(0, self::CONFIG['headLines']['limit']);
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
            $offset = ($this->totalNumNews - self::CONFIG['headLines']['limit']) - self::CONFIG['newsPagination']['limit'];
            return $this->selectNews($offset, self::CONFIG['newsPagination']['limit'])
        }
        catch (OutOfRangeException $e) {
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