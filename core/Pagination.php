<?

namespace Youpi;

class Pagination
{
    protected int $countPages;
    protected int $currentPage;
    protected string $uri;

    protected int $perPage;
    protected int $totalRecords;
    protected int $midSize = 2;
    protected int $maxPages;
    protected string $tpl;

    public function __construct($perPage = 1, $totalRecords = 1, $midSize = 2, $maxPages = 7, $tpl = 'pagination/base')
    {
        $this->perPage = $perPage;
        $this->totalRecords = $totalRecords;
        $this->maxPages =  $maxPages;
        $this->midSize = $midSize;
        $this->tpl = $tpl;

        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    protected function getCountPages(): int
    {
        return (int)ceil($this->totalRecords / $this->perPage) ?: 1;
    }

    protected function getCurrentPage(): int
    {
        $page = (int)request()->get('page', 1);
        if ($page < 1 || $page > $this->countPages) {
            abort();
        }
        return $page;
    }

    protected function getParams(): string
    {
        $url = request()->uri;
        $url = parse_url($url);

        $uri = $url['path'];
        if (!empty($url['query']) && $url['query'] != '&') {
            parse_str($url['query'], $params);
            if (isset($params['page'])) {
                unset($params['page']);
            }

            if (!empty($params)) {
                $uri = '?' . http_build_query($params);
            }
        }
        return $uri;
    }

    protected function getMidSize(): int
    {
        return $this->countPages <= $this->maxPages ? $this->countPages : $this->midSize;
    }

    protected function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }
}
