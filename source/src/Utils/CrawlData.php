<?php
namespace App\Utils;

use Goutte\Client;

abstract class CrawlData {
    protected $crawler;
    public $result = [];
    protected $href;
    protected $baseHref;

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