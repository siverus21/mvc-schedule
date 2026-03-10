<?php

namespace Youpi\Contracts;

/**
 * Общий контракт для драйверов кэша (файловый, Redis и т.д.).
 * Позволяет переключать реализацию без изменения кода приложения.
 */
interface CacheInterface
{
    /**
     * Записать значение в кэш.
     *
     * @param string $key   Ключ
     * @param mixed  $data  Значение (скаляр, массив, объект — сериализуется реализацией)
     * @param int    $seconds TTL в секундах (0 = без срока)
     */
    public function set(string $key, mixed $data, int $seconds = 3600): bool;

    /**
     * Прочитать значение из кэша.
     *
     * @param string $key     Ключ
     * @param mixed  $default Значение по умолчанию, если ключа нет или истёк TTL
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Удалить значение по ключу.
     */
    public function delete(string $key): bool;

    /**
     * Проверить наличие ключа в кэше.
     */
    public function has(string $key): bool;
}
