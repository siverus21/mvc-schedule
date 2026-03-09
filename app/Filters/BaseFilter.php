<?

namespace App\Filters;

abstract class BaseFilter
{
    /**
     * Базовый метод рендера фильтра.
     * Дочерние классы обязаны его реализовать.
     */
    abstract public static function renderHTML();

    /**
     * Общий рендер для select-фильтров.
     * Ожидает, что в дочернем классе определены static $id, $name, $title, $disableItemText.
     */
    protected static function renderDefaultSelect(array $items): string
    {
        return view()->renderPartial('incs/filters/defaultSelectFilter', [
            'items'           => $items,
            'disableItemText' => static::$disableItemText ?? '',
            'id'              => static::$id ?? '',
            'name'            => static::$name ?? '',
            'title'           => static::$title ?? '',
        ]);
    }
}
