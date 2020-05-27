<?php


namespace Soen\Filesystem;


use FilesystemIterator;
use Soen\Filesystem\Exception\FileException;

class File
{
    public $dirPath;
    /**
     * @var FilesystemIterator
     */
    public $filesystemIterator;
    function __construct($dir = './d')
    {
        if(!is_dir($dir)) {
            throw new FileException('不是目录', 0);
        }
        $this->dirPath = $dir;
        $this->createFilesystemIterator();
    }

    function createFilesystemIterator(){
        $this->filesystemIterator = new FilesystemIterator($this->dirPath);
    }

    function getFilesystemIterator(){
        return $this;
    }

    /**
     * @param array $array
     * @return array
     */
    function readArrayFilesDeep(&$array = []):array {
        $files = $this->filesystemIterator;
        while ($files->valid()){
            if($files->isDir()){
//                $files = $files->current();
                $this->readArrayFilesDeep();
            } else {
                $filePath = $files->getPathname();
                if($files->getExtension() === 'php') {
//                    $array = array_merge($array, require_once $filePath);
                    $array[] = require_once $filePath;
                }
            }
            $files->next();
        }
        return $array;
    }
}