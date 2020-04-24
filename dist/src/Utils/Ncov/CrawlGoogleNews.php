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
use Symfony\Component\DomCrawler\Crawler;

class CrawlGoogleNews extends CrawlData {
    public function __construct() {
        $this->href = 'https://news.google.com/topics/CAAqKAgKIiJDQkFTRXdvTkwyY3ZNVEZtY2pFMWRERTFhQklDZG1rb0FBUAE?hl=vi&gl=VN&ceid=VN%3Avi';
        parent::__construct();
    }

    public function extractData()
    {
        $this->crawler->filter('.xrnccd .Cc0Z5d')->each(function (Crawler $node) {
            $previous = $node->previousAll();
            $children = $node->children();
            $title = $children->children('.DY5T1d')->text();
            $link = $this->baseHref . substr($children->children('.DY5T1d')->attr('href'), 2);
            $source = $children->children('[jsname="Hn1wIf"] .wEwyrc')->text();
            $img = $previous->getNode(0) ? $previous->children()->children('img.QwxBBf') : null;
            $imgUri = $img ? $img->attr('src') : '';
            $item = array(
                'title' => $title,
                'link'  => $link,
                'source' => $source,
                'imgUri' => $imgUri
            );
            array_push($this->result, $item);
        });
    }
}

?>