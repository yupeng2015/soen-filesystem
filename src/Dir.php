<?php


namespace Soen\Filesystem;


use Soen\Filesystem\Exception\FileException;
use Throwable;

class Dir
{
    public $dir;
    public $directoryIterator;
    public $filesystemIterator;
    function __construct($dir = './d', \DirectoryIterator $directoryIterator)
    {
        if(!is_dir($dir)) {
            throw new FileException('不是目录', 0);
        }
        $this->dir = $dir;
        $this->createDirectoryIterator();
//        $this->filesystemIterator = $filesystemIterator;
//        $this->directoryIterator = new $directoryIterator($dir);
    }

    function createDirectoryIterator(){
        $this->directoryIterator = new \DirectoryIterator($this->dir);
    }

    function getDirectoryIterator () {
        return $this->directoryIterator;
    }

    /**
     * @param string $dir
     * @throws FileException
     */
    function readFilesFromDir() {

    }
}