<?php

namespace IqTool\Ci3LogViewer\Cache;

class Ci3CacheAdapter implements CacheInterface
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('cache', ['adapter' => 'file']);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->CI->cache->get($key);
        return $value === false ? $default : $value;
    }

    public function put(string $key, mixed $value, int $ttl = 0): bool
    {
        // 0 TTL or less in CI3 typically means infinite or a standard default; we use 1 year (31536000 seconds) if 0 or omitted
        $seconds = $ttl > 0 ? $ttl : 31536000;
        return (bool) $this->CI->cache->save($key, $value, $seconds);
    }

    public function forget(string $key): bool
    {
        return (bool) $this->CI->cache->delete($key);
    }

    public function has(string $key): bool
    {
        return $this->CI->cache->get($key) !== false;
    }
}
