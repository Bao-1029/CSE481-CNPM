<?php
namespace App\Utils;

use Goutte\Client;

abstract class CrawlData {
    protected $crawler;
    public $result = [];
    protected $href;
    protected $baseHref;
    protected $encoding;
    protected static $encoding_list = [
        "UTF-8",
        "UTF-7",
        "UTF-16",
        "UTF-32",
        "ISO-8859-16",
        "ISO-8859-15",
        "ISO-8859-10",
        "ISO-8859-1",
        "Windows-1254",
        "Windows-1252",
        "Windows-1251",
        "ASCII",
    ];

    public function __construct()
    {
        $client = new Client();
        $this->crawler = $client->request('GET', $this->href);
        $this->baseHref = $this->crawler->getBaseHref();
        $this->extractData();
        return $this->result;
    }

    public abstract function extractData();
}

?>