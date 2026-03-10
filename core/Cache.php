<?php

namespace Youpi;

use Youpi\Contracts\CacheInterface;

/**
 * Файловый драйвер кэша. Хранит данные в CACHE_PATH, ключи — md5 хэш.
 */
class Cache implements CacheInterface
{
    private string $path;

    public function __construct(?string $path = null)
    {
        $this->path = $path ?? CACHE_PATH;
    }

    private function filePath(string $key): string
    {
        return $this->path . '/' . md5($key) . '.txt';
    }

    public function set(string $key, mixed $data, int $seconds = 3600): bool
    {
        $content = [
            'data' => $data,
            'ttl'  => time() + $seconds,
        ];
        $file = $this->filePath($key);
        return file_put_contents($file, serialize($content)) !== false;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $file = $this->filePath($key);
        if (!is_file($file)) {
            return $default;
        }
        $raw = @file_get_contents($file);
        if ($raw === false) {
            return $default;
        }
        $content = @unserialize($raw);
        if (!is_array($content) || !isset($content['data'], $content['ttl'])) {
            @unlink($file);
            return $default;
        }
        if (time() >= $content['ttl']) {
            @unlink($file);
            return $default;
        }
        return $content['data'];
    }

    public function delete(string $key): bool
    {
        $file = $this->filePath($key);
        if (is_file($file)) {
            return @unlink($file);
        }
        return true;
    }

    public function has(string $key): bool
    {
        $file = $this->filePath($key);
        if (!is_file($file)) {
            return false;
        }
        $raw = @file_get_contents($file);
        if ($raw === false) {
            return false;
        }
        $content = @unserialize($raw);
        return is_array($content) && isset($content['ttl']) && time() < $content['ttl'];
    }
}
