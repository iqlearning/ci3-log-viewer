<?php

namespace IqTool\Ci3LogViewer\Cache;

interface CacheInterface
{
    public function get(string $key, mixed $default = null): mixed;
    public function put(string $key, mixed $value, int $ttl = 0): bool;
    public function forget(string $key): bool;
    public function has(string $key): bool;
}
