<?

namespace Youpi;

class File
{

    protected string    $name;
    protected string    $type;
    protected string    $tmpName;
    protected int       $error;
    protected int       $size;
    protected bool      $isFile;

    public function __construct(string $name)
    {
        $files = request()->files;

        $this->name = $files[$name]['name'] ?? '';
        $this->type = $files[$name]['type'] ?? '';
        $this->tmpName = $files[$name]['tmp_name'] ?? '';
        $this->error = $files[$name]['error'] ?? 4;
        $this->size = $files[$name]['size'] ?? 0;
        $this->isFile = is_file($this->tmpName);
    }

    public function save($folder = ''): bool|string
    {
        if (!$this->isFile()) {
            return false;
        }

        $dir = UPLOADS;
        if ($folder) {
            $dir .= '/' . trim($folder, '/');
        }

        $dir .= '/' . date('Y') . '/' . date('m') . '/' . date('d');
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $dirUrl = str_replace(PUBLIC_PATH, '', $dir);
        $fileName = md5($this->name . time()  . uniqid('', true)) . '.' . $this->getExt();

        $fileUrl = $dirUrl . '/' . $fileName;
        $filePath = $dir . '/' . $fileName;

        if (move_uploaded_file($this->tmpName, $filePath)) {
            return $fileUrl;
        }

        return false;
    }

    public function getExt(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    public function getError(): int
    {
        return $this->error;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function isFile(): bool
    {
        return $this->isFile;
    }
}
