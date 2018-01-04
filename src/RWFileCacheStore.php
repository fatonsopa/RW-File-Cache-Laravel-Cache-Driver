<?php
namespace RapidWeb\RwFileCacheLaravelCacheDriver;

use Illuminate\Contracts\Cache\Store;
use rapidweb\RWFileCache\RWFileCache;

class RWFileCacheStore implements Store
{
    private $prefix = '';
    private $rwFileCache;

    public function __construct()
    {
        $this->rwFileCache = new RWFileCache;
    }

    public function changeConfig($config)
    {
        return $this->rwFileCache->changeConfig($config);
    }

    public function get($key) 
    {
        return $this->rwFileCache->get($this->prefix.$key);
    }

    public function many(array $keys)
    {
        $results = [];

        foreach($keys as $key) {
            $results[$key] = $this->get($key);
        }

        return $results;
    }

    private function convertMinutesToSeconds($minutes)
    {
        $seconds = $minutes * 60;
        return $seconds;
    }

    public function put($key, $value, $minutes)
    {
        return $this->rwFileCache->set($this->prefix.$key, $value, $this->convertMinutesToSeconds($minutes));
    }

    public function putMany(array $values, $minutes)
    {
        foreach ($values as $key => $value) {
            $this->put($key, $value, $minutes);
        }
    }

    public function increment($key, $value = 1)
    {
        return $this->rwFileCache->increment($this->prefix.$key, $value);
    }

    public function decrement($key, $value = 1)
    {
        return $this->rwFileCache->decrement($this->prefix.$key, $value);
    }

    public function forever($key, $value)
    {
        return $this->put($key, $value, 0);
    }

    public function forget($key)
    {
        return $this->rwFileCache->delete($this->prefix.$key);
    }
    
    public function flush()
    {
        return $this->rwFileCache->flush();
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }
}
