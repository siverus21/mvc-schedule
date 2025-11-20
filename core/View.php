<?

namespace Youpi;

class View
{

    public string $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $data = [], $layout = ''): string
    {
        extract($data);
        $viewFile = VIEWS . "/{$view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require $viewFile;
            $content = ob_get_clean();
        } else {
            abort("View {$viewFile} not found", 404);
        }

        if ($layout == false) return $content;

        $layoutFileName = $layout ?: $this->layout;
        $layoutFile = LAYOUTS . "/{$layoutFileName}.php";
        if (is_file($layoutFile)) {
            ob_start();
            require $layoutFile;
            return ob_get_clean();
        } else {
            abort("Layout {$layoutFile} not found", 500);
        }
        return '';
    }

    public function renderPartial($view, $data = []): string
    {
        extract($data);
        $viewFile = VIEWS . "/{$view}.php";
        if (is_file($viewFile)) {
            ob_start();
            require $viewFile;
            return ob_get_clean();
        } else {
            return "File {$viewFile} not found";
        }
    }
}
