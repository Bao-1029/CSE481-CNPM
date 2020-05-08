<?php
namespace App\Utils\Ncov;

use App\Utils\CrawlData;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlTimeline extends CrawlData
{
    public function __construct()
    {
        $this->href = 'https://ncov.moh.gov.vn/dong-thoi-gian';
        parent::__construct();
    }

    public function extractData()
    {
        $this->crawler->filter('.timeline-sec .timeline-content')->each(function (Crawler $node) {
            /* $children = $node->children();
            $title = $children->children('.DY5T1d')->text();
            $link = $this->baseHref . substr($children->children('.DY5T1d')->attr('href'), 2);
            $source = $children->children('[jsname="Hn1wIf"] .wEwyrc')->text();
            $item = array(
                'title' => $title,
                'link'  => $link,
                'source' => $source
            );
            array_push($this->result, $item); */
            array_push($this->result, $node->text());
        });
    }
}
?>