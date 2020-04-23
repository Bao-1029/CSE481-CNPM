<?php
namespace App\Utils;

use OutOfRangeException;

class JsonParser {
    protected $dir;
    protected $file;
    /**
     * @param {string} $dir directory of the storage (folder where it is stored)
     */
    public function __construct(String $dir)
    {
        $dir = realpath($dir);
        if (!is_dir($dir))
            throw new \InvalidArgumentException(
                sprintf("The directory at %s not exists", $dir), 1);
            
        $this->dir = $dir;
    }

    public function getLastestFile() {
        return $this->getFileByIndex(0);
    }

    public function getFileByIndex($index) {
        $all_file = self::getListFileByDescending($this->dir);
        if (!isset($all_file[$index]))
            throw new OutOfRangeException("Error Processing Request", 1);
            
        $this->file = file($all_file[$index]);
        return $this;
    }

    public function decode() {
        return json_decode($this->file);
    }

    private function getListFileByDescending(String $dir):array
    {
        return array_diff(scandir($this->dir, SCANDIR_SORT_DESCENDING), ['..', '.']);
    }
}
?>