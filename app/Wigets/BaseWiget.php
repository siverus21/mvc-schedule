<?

namespace App\Wigets;

abstract class BaseWiget
{
    public static string $name;
    public static string $icon;
    public static string $color_icon;

    /**
     * Рендер виджета. Дочерние классы обязаны реализовать.
     */
    abstract public static function renderHTML(): string;

    /**
     * Общий рендер блока с счётчиком (шаблон incs/wigets/defaultBlock).
     */
    protected static function renderDefaultBlock(int $count): string
    {
        return view()->renderPartial('incs/wigets/defaultBlock', [
            'count'      => $count,
            'name'       => static::$name ?? '',
            'icon'       => static::$icon ?? '',
            'color_icon' => static::$color_icon ?? '',
        ]);
    }
}
