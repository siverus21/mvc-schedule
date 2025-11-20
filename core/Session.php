<?

namespace Youpi;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function get($name, $default = null)
    {
        return $_SESSION[$name] ?? $default;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function isSet($name)
    {
        return isset($_SESSION[$name]);
    }

    public function delete($name)
    {
        if (isset($_SESSION[$name]))
            unset($_SESSION[$name]);
    }

    public function setFlash($name, $value)
    {
        $_SESSION['_flash'][$name] = $value;
    }

    public function getFlash($name, $default = null)
    {
        if (isset($_SESSION['_flash'][$name])) {
            $val = $_SESSION['_flash'][$name];
            unset($_SESSION['_flash'][$name]);
        }

        return $val ?? $default;
    }

    public function getAllSession()
    {
        return $_SESSION;
    }
}
