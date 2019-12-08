<?php

namespace App\Services;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Created by PhpStorm.
 * User: Shadow
 * Date: 10/11/2019
 * Time: 11:06
 */
class CacheService
{
    private $cache;
    
    public function __construct ()
    {
        $this->cache = new FilesystemAdapter();
    }
    
    public function getCache() 
    {
        return $this->cache;
    }
}