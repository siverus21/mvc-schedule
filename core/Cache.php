<?

namespace Youpi;

class Cache
{
    public function set($key, $data, $seconds = 3600): void
    {
        $content['data'] = $data;
        $content['ttl'] = time() + $seconds;

        $chacheFile = CACHE_PATH . '/' . md5($key) . '.txt';
        file_put_contents($chacheFile, serialize($content));
    }

    public function get($key, $default = null): mixed
    {
        $chacheFile = CACHE_PATH . '/' . md5($key) . '.txt';
        if (file_exists($chacheFile)) {
            $content = unserialize(file_get_contents($chacheFile));
            if (time() < $content['ttl']) {
                return $content['data'];
            }
            @unlink($chacheFile);
        }
        return $default;
    }

    public function remove($key): void
    {
        $chacheFile = CACHE_PATH . '/' . md5($key) . '.txt';
        if (file_exists($chacheFile))
            @unlink($chacheFile);
    }
}
