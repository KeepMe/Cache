<?php

namespace KeepMe\Cache;

/**
 * Interface LazyCache
 *
 * The key words "MUST", "MUST NOT", "REQUIRED", "SHALL", "SHALL NOT", "SHOULD", "SHOULD NOT", "RECOMMENDED", "MAY",
 * and "OPTIONAL" in this document are to be interpreted as described in RFC 2119.
 */
interface LazyCache
{

    /**
     * Fetches a value from the cache, if a not expired cache item for the provided key exists. Otherwise persists a
     * value computed by the callable under the given key and returns it.
     *
     * The value returned by this method MUST be identical to the value originally computed by the callable. The
     * callable MUST NOT be called if a not expired cache item for the provided key exists.
     *
     * @param string   $key      The unique key of the cache item.
     * @param callable $callable The callable that can compute a value to be cached. The callable MUST NOT have any
     *                           required arguments. The value returned by the callable MUST be serializable.
     * @param null|int $ttl      The expiration time for this cache item in seconds. If none is set, the value SHOULD
     *                           be stored permanently or for as long as the implementation allows.
     *
     * @return mixed The value returned by the callable.
     *
     * @throws \KeepMe\Cache\InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function cache($key, callable $callable, $ttl = null);

    /**
     * Removes the cached item.
     *
     * @param string $key The unique cache key of the item to delete.
     *
     * @return bool True if the cached entry was successfully removed. False if there was an error.
     *
     * @throws \KeepMe\Cache\InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function delete($key);

    /**
     * Deletes all items in the cache.
     *
     * @return bool True if the cache was successfully cleared. False if there was an error.
     */
    public function clear();

}