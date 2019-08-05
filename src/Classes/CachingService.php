<?php
namespace JournalMedia\Sample\Classes;

use phpFastCache\Helper\Psr16Adapter as CacheManager;

/**
 * @codeCoverageIgnore
 */
class CachingService
{
    const FAST_CACHE_DRIVER = 'Predis';
    const CACHE_TIMEOUT = 86400; // 24 hours

    public $cacheManager;

    public function __construct()
    {
        $this->cacheManager = new CacheManager(self::FAST_CACHE_DRIVER);
    }

    private function createCacheKey($endpoint)
    {
        return hash('sha256', $endpoint);
    }

    public function get($endpoint)
    {
        $key = $this->createCacheKey($endpoint);
        return $this->cacheManager->get($key) ?: false;
    }

    public function set($endpoint, $response, $timeout = null)
    {
        $key = $this->createCacheKey($endpoint);
        return $this->cacheManager->set($key, $response, ($timeout ?: self::CACHE_TIMEOUT));
    }

    public function clear()
    {
        $cache = $this->cacheManager->clear();
        return strtolower($cache->__toString()) == 'ok';
    }
}
