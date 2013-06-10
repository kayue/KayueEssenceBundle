<?php

namespace Kayue\EssenceBundle\Essence;

use Doctrine\Common\Cache\CacheProvider;

class Cache implements \fg\Essence\Cache
{
    /**
     * @var \Doctrine\Common\Cache\CacheProvider
     */
    protected $cacheProvider;

    function __construct(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        $this->cacheProvider->setNamespace('KayueEssenceBundle');
    }

    /**
     * Returns if data exists for the given key.
     *
     * @param  string  $key The key to test.
     *
     * @return boolean Whether there is data for the key or not.
     */
    public function has($key)
    {
        return $this->cacheProvider->contains($key);
    }

    /**
     * Returns the data for the given key.
     *
     * @param  string $key     The key to search for.
     * @param  mixed  $default Default value to return if there is no data.
     *
     * @return mixed  The cached data, default value or null, if no cache entry exists for the given id.
     */
    public function get($key, $default = false)
    {
        $data = $this->cacheProvider->fetch($key);

        if($data === false && $default !== false) {
            return $default;
        } elseif ($data === false) {
            return null;
        }

        return $data;
    }

    /**
     * Sets the data for the given key.
     *
     * @param  string $key  The key for the data.
     * @param  mixed  $data The data.
     *
     * @return bool
     */
    public function set($key, $data)
    {
        return $this->cacheProvider->save($key, $data);
    }

    /**
     * Deletes all cached data.
     */
    public function clear()
    {
        return $this->cacheProvider->flushAll();
    }
}