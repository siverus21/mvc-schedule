<?php

namespace Youpi;

use Youpi\Contracts\CacheInterface;

/**
 * Драйвер кэша на Redis. Поддерживает префикс ключей и TTL.
 */
class CacheRedis implements CacheInterface
{
    private \Redis $redis;
    private string $prefix;

    public function __construct(
        string $address = REDIS_IP,
        int|string $port = REDIS_PORT,
        ?string $prefix = null
    ) {
        if (!class_exists(\Redis::class)) {
            throw new \RuntimeException('Расширение phpredis (класс Redis) не установлено.');
        }
        $this->redis = new \Redis();
        $this->prefix = (string) $prefix;
        $this->connect($address, (int) $port);
    }

    private function connect(string $address, int $port): void
    {
        $ok = @$this->redis->connect($address, $port);
        if ($ok === false) {
            throw new \RuntimeException("Не удалось подключиться к Redis {$address}:{$port}");
        }
    }

    private function prefixedKey(string $key): string
    {
        return $this->prefix !== '' ? $this->prefix . $key : $key;
    }

    private function encode(mixed $data): string
    {
        if (is_scalar($data) || $data === null) {
            return (string) $data;
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $json !== false ? $json : serialize($data);
    }

    private function decode(string $value): mixed
    {
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }
        $unserialized = @unserialize($value);
        return $unserialized !== false ? $unserialized : $value;
    }

    public function set(string $key, mixed $data, int $seconds = 3600): bool
    {
        $key = $this->prefixedKey($key);
        $value = $this->encode($data);
        if ($seconds > 0) {
            return (bool) $this->redis->setex($key, $seconds, $value);
        }
        return (bool) $this->redis->set($key, $value);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $key = $this->prefixedKey($key);
        $val = $this->redis->get($key);
        if ($val === false) {
            return $default;
        }
        return $this->decode($val);
    }

    public function delete(string $key): bool
    {
        $key = $this->prefixedKey($key);
        return $this->redis->del($key) > 0;
    }

    public function has(string $key): bool
    {
        $key = $this->prefixedKey($key);
        return (bool) $this->redis->exists($key);
    }

    public function close(): void
    {
        try {
            $this->redis->close();
        } catch (\Throwable $e) {
            // игнорируем при закрытии
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
