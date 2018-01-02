<?php

use PHPUnit\Framework\TestCase;
use RapidWeb\RwFileCacheLaravelCacheDriver\RWFileCacheStore;

final class CacheStorageAndRetrievalTest extends TestCase
{
    private $cache = null;

    public function setUp()
    {
        $this->cache = new RWFileCacheStore;
        $this->cache->changeConfig(['cacheDirectory' => __DIR__.'/Data/']);
    }

    public function testBasicString()
    {
        $stored = 'Mary had a little lamb.';

        $key = __FUNCTION__;
        $this->cache->put($key, $stored, strtotime('+ 1 day'));

        $retrieved = $this->cache->get($key);

        $this->assertEquals($stored, $retrieved);
    }

    public function testEmptyArray()
    {
        $stored = [];

        $key = __FUNCTION__;
        $this->cache->put($key, $stored, strtotime('+ 1 day'));

        $retrieved = $this->cache->get($key);

        $this->assertEquals($stored, $retrieved);
    }

    public function testNumericZero()
    {
        $stored = 0;

        $key = __FUNCTION__;
        $this->cache->put($key, $stored, strtotime('+ 1 day'));

        $retrieved = $this->cache->get($key);

        $this->assertEquals($stored, $retrieved);
    }

    public function testBooleanFalse()
    {
        $stored = false;

        $key = __FUNCTION__;
        $this->cache->put($key, $stored, strtotime('+ 1 day'));

        $retrieved = $this->cache->get($key);

        $this->assertEquals($stored, $retrieved);
    }

    public function testBooleanTrue()
    {
        $stored = false;

        $key = __FUNCTION__;
        $this->cache->put($key, $stored, strtotime('+ 1 day'));

        $retrieved = $this->cache->get($key);

        $this->assertEquals($stored, $retrieved);
    }
}