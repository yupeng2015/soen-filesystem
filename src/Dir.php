<?php


namespace Soen\Filesystem;


use Soen\Filesystem\Exception\FileException;
use Throwable;

class Dir
{
    public $dir = '';
    public $filesystemIterator;
    function __construct($dir = './d', \FilesystemIterator $filesystemIterator)
    {
        if(!is_dir($dir)) {
            throw new FileException('不是目录', 0);
        }
        $this->dir = $dir;
        $this->filesystemIterator = $filesystemIterator;
    }

    /**
     * @param string $dir
     * @throws FileException
     */
    function readFilesFromDir() {

    }
}