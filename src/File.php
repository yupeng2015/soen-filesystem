<?php


namespace Soen\Filesystem;


use FilesystemIterator;

class File extends FilesystemIterator
{
    function readArrayFilesDeep(File $files, &$config = []):array {
        while ($files->valid()){
            if($files->isDir()){
                $this->readArrayFilesDeep(new File($files->current()), $config);
            } else {
                $filePath = $files->current();
                if($files->getExtension() === 'php') {
                    $config = array_merge($config, require_once $filePath);
                }
            }
            $files->next();
        }
        return $config;
    }
}