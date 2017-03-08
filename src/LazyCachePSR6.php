<?php

namespace KeepMe\Cache;

use KeepMe\Cache\Contract\LazyCache;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class LazyCachePSR6
 *
 * @package KeepMe\Cache
 */
class LazyCachePSR6 implements LazyCache
{

    /**
     * @var CacheItemPoolInterface
     */
    protected $pool;

    /**
     * LazyCachePSR6 constructor.
     *
     * @param CacheItemPoolInterface $pool
     */
    public function __construct(CacheItemPoolInterface $pool)
    {
        $this->pool = $pool;
    }

    /**
     * @param string   $key
     * @param callable $callable
     * @param int|null $ttl
     *
     * @return mixed
     */
    public function cache($key, callable $callable, $ttl = null)
    {

        try {

            $item = $this->pool->getItem($key);

            if (!$item->isHit()) {
                $item->set($callable());
                $item->expiresAfter($ttl);
                $this->pool->save($item);
            }

            return $item->get();

        } catch (\Psr\Cache\InvalidArgumentException $e) {

            throw new InvalidArgumentException("Invalid argument!", 0, $e);

        }

    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function delete($key)
    {

        try {

            return $this->pool->deleteItem($key);

        } catch (\Psr\Cache\InvalidArgumentException $e) {

            throw new InvalidArgumentException("Invalid argument!", 0, $e);

        }

    }

    /**
     * @return mixed
     */
    public function clear()
    {
        return $this->pool->clear();
    }

}

