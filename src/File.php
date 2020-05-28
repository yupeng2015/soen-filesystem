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
    function __construct()
    {
    }
    public function setDirPath(string $dir){
        if(!is_dir($dir)) {
            throw new FileException('不是目录', 0);
        }
        $this->dirPath = $dir;
    }

    function createFilesystemIterator(string $dir){
        $this->setDirPath($dir);
        $this->filesystemIterator = new FilesystemIterator($this->dirPath);
        return $this;
    }

    function getFilesystemIterator(){
        return $this;
    }

    function readFilesRequire(){
        $files = $this->filesystemIterator;
        while ($files->valid()){
            if($files->isDir()){
//                $files = $files->current();
                $this->readArrayFilesDeep();
            } else {
                $filePath = $files->getPathname();
                if($files->getExtension() === 'php') {
                    require_once $filePath;
                }
            }
            $files->next();
        }
//        return $array;
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