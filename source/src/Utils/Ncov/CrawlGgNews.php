<?php
namespace App\Utils\Ncov;

/**
 * Scrape Google News
 * css selector
 * node: .xrnccd
 * img: .QwxBBf
 * article: .xrnccd .Cc0Z5d
 * title: .DY5T1d
 * link: .DY5T1d
 * summary: .xBbh9
 * source: [jsname="Hn1wIf"] .wEwyrc
 * time: .WW6dff
 * 
 * @see https://symfony.com/doc/current/components/dom_crawler.html?any
 */

use App\Utils\CrawlData;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlGgNews extends CrawlData {
    public function __construct() {
        $this->href = 'https://news.google.com/topics/CAAqKAgKIiJDQkFTRXdvTkwyY3ZNVEZxT0dzelpHZG9aeElDZG1rb0FBUAE?hl=vi&gl=VN&ceid=VN%3Avi';
        parent::__construct();
    }

    public function extractData()
    {
        $this->crawler->filter('.xrnccd .Cc0Z5d')->each(function (Crawler $node) {
            $children = $node->children();
            $title = $children->children('.DY5T1d')->text();
            $link = $this->baseHref . substr($children->children('.DY5T1d')->attr('href'), 2);
            $source = $children->children('[jsname="Hn1wIf"] .wEwyrc')->text();
            $item = array(
                'title' => $title,
                'link'  => $link,
                'source' => $source
            );
            array_push($this->result, $item);
        });
    }
}

?>