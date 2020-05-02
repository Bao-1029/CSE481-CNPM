<?php
declare(strict_types=1);

namespace App\Domain\News;

use JsonSerializable;

class News implements JsonSerializable {
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $source;
    
    /**
     * @var string|null
     */
    private $imgUri;

    /* public function __construct($title, $link, $source, $imgUri)
    {
        $this->title = $title;
        $this->link = $link;
        $this->source = $source;
        $this->imgUri = $imgUri;
    } */

    public function __get(String $key) {
        if (property_exists($this, $key))
            return $this->$key;
        else
            die("Property not exists");
    }

    public function __sleep() {
        return array('title', 'link', 'source', 'imgUri');
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'link' => $this->link,
            'source' => $this->source,
            'imgUri' => $this->imgUri
        ];
    }
}
?>