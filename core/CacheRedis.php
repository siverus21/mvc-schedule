<?php

namespace Youpi;

class CacheRedis
{
    private $redis;
    private $address;
    private $port;
    private $prefix;

    public function __construct($address = REDIS_IP, $port = REDIS_PORT, $prefix = null)
    {
        if (!class_exists('Redis')) {
            throw new \RuntimeException('Расширение phpredis (класс Redis) не установлено.');
        }

        $this->address = $address;
        $this->port = (int)$port;
        $this->prefix = $prefix;

        $this->redis = new \Redis();
        $this->connect();
    }

    private function connect()
    {
        // @ подавляет предупреждения, мы обрабатываем результат вручную
        $ok = @$this->redis->connect($this->address, $this->port);
        if ($ok === false) {
            throw new \RuntimeException("Не удалось подключиться к Redis {$this->address}:{$this->port}");
        }
    }

    private function prefixedKey($key)
    {
        return $this->prefix ? $this->prefix . $key : $key;
    }

    public function set($key, $data, $seconds = 3600)
    {
        $key = $this->prefixedKey((string)$key);

        if (is_scalar($data) || $data === null) {
            $value = (string)$data;
        } else {
            $value = json_encode($data, JSON_UNESCAPED_UNICODE);
            if ($value === false) {
                $value = serialize($data);
            }
        }

        if ((int)$seconds > 0) {
            return (bool)$this->redis->setex($key, (int)$seconds, $value);
        } else {
            return (bool)$this->redis->set($key, $value);
        }
    }

    public function get($key)
    {
        $key = $this->prefixedKey((string)$key);
        $val = $this->redis->get($key);
        if ($val === false) {
            return false;
        }

        $decoded = json_decode($val, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        if (@unserialize($val) !== false || $val === 'b:0;') {
            $u = @unserialize($val);
            if ($u !== false) {
                return $u;
            }
        }

        return $val;
    }

    public function delete($key)
    {
        $key = $this->prefixedKey((string)$key);
        return $this->redis->del($key);
    }


    public function isSet($key)
    {
        $key = $this->prefixedKey((string)$key);
        // EXISTS возвращает 1/0
        return (bool)$this->redis->exists($key);
    }

    public function close()
    {
        if ($this->redis instanceof \Redis) {
            try {
                $this->redis->close();
            } catch (\Exception $e) {
            }
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
