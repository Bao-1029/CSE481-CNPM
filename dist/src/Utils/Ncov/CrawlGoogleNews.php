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
use Exception;
use Symfony\Component\DomCrawler\Crawler;

class CrawlGoogleNews extends CrawlData {
    public function __construct() {
        $this->href = 'https://news.google.com/topics/CAAqKAgKIiJDQkFTRXdvTkwyY3ZNVEZtY2pFMWRERTFhQklDZG1rb0FBUAE?hl=vi&gl=VN&ceid=VN%3Avi';
        parent::__construct();
    }

    public function extractData()
    {
        $this->crawler->filter('.xrnccd .Cc0Z5d')->each(function (Crawler $node) {
            $parents = $node->parents();
            $children = $node->children();
            $title = $children->children('.DY5T1d')->text();
            $link = $this->baseHref . substr($children->children('.DY5T1d')->attr('href'), 2);
            $source = $children->children('[jsname="Hn1wIf"] .wEwyrc')->text();
            $a = $parents->previousAll();
            if ($a->getNode(0))
            {
                $figure = $a->children();
                $img = $figure->children('img.QwxBBf');
                $imgUri = $img ? $img->attr('src') : '';
            } else
                $imgUri = '';
            /*
             * Error: Malformed UTF-8 characters, possibly incorrectly encoded
             * https://stackoverflow.com/questions/50610990/php-json-encode-is-getting-malformed-utf-8-characters-possibly-incorrectly-e
             * RESOL
             
            $this->encoding = mb_detect_encoding($title, self::$encoding_list, true);
            $item = array(
                'title' => mb_convert_encoding($title, 'UTF-8', $this->encoding),
                'link'  => $link,
                'source' => mb_convert_encoding($source, 'UTF-8', $this->encoding),
                'imgUri' => $imgUri
            );
            */
            // https://stackoverflow.com/a/29667430
            // try {
            //     $item = array(
            //         'title' => iconv(mb_detect_encoding($title, mb_detect_order(), false), 'UTF-8//IGNORE', $title),
            //         'link'  => $link,
            //         'source' => iconv(mb_detect_encoding($source, mb_detect_order(), false), 'UTF-8//IGNORE', $source),
            //         'imgUri' => $imgUri
            //     );
            //     array_push($this->result, $item);
            // } catch (Exception $e) {

            // }
            /* $item = array(
                'title' => utf8_encode($title),
                'link'  => $link,
                'source' => utf8_encode($source),
                'imgUri' => $imgUri
            );
            array_push($this->result, $item); */
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