<?

namespace Youpi;

class Pagination
{
    protected int $countPages;
    protected int $currentPage;
    protected string $uri;

    protected int $totalRecords; // Общее количество элементов
    protected int $perPage; // Количество элементов на странице
    protected int $midSize = 2; // Количество элементов слева и справа от текущего
    protected int $maxPages; // ограничить количество видимых номеров страниц в пагинации
    protected string $tpl; // шаблон

    public function __construct($totalRecords, $perPage = 1, $midSize = 2, $maxPages = 5, $tpl = 'pagination/base')
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

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getLimit(): int
    {
        return $this->perPage;
    }

    public function getHtml()
    {
        $prev = '';
        $next = '';
        $firstPage = '';
        $lastPage = '';
        $pagesLeft = [];
        $pagesRight = [];
        $currentPage = $this->currentPage;

        if ($this->currentPage > 1) {
            $prev = $this->getLink($this->currentPage - 1);
        }

        if ($this->currentPage < $this->countPages) {
            $next = $this->getLink($this->currentPage + 1);
        }

        if ($this->currentPage > $this->midSize + 1) {
            $firstPage = $this->getLink(1);
        }

        if ($this->currentPage < ($this->countPages - $this->midSize)) {
            $lastPage = $this->getLink($this->countPages);
        }

        for ($i = $this->midSize; $i > 0; $i--) {
            if ($this->currentPage - $i > 0) {
                $pagesLeft[] = [
                    'link' => $this->getLink($this->currentPage - $i),
                    'number' => $this->currentPage - $i,
                ];
            }
        }

        for ($i = 1; $i <= $this->midSize; $i++) {
            if ($this->currentPage + $i <= $this->countPages) {
                $pagesRight[] = [
                    'link' => $this->getLink($this->currentPage + $i),
                    'number' => $this->currentPage + $i,
                ];
            }
        }

        return view()->renderPartial($this->tpl, compact('prev', 'next', 'firstPage', 'lastPage', 'pagesLeft', 'pagesRight', 'currentPage'));
    }

    protected function getLink($page): string
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }
        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}&page={$page}"; // users?status=1&page={$page}
        } else {
            return "{$this->uri}?page={$page}"; // users?page={$page}
        }
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }
}
