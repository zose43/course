<?php

namespace App\MoonShine\Resources;

use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Fields\Image;
use Domain\Product\Models\Product;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Decorations\Tab;
use Leeto\MoonShine\Fields\BelongsTo;
use Leeto\MoonShine\Decorations\Tabs;
use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Fields\SwitchBoolean;
use Leeto\MoonShine\Fields\BelongsToMany;
use Leeto\MoonShine\Actions\FiltersAction;
use Leeto\MoonShine\Filters\BelongsToFilter;
use Leeto\MoonShine\Filters\BelongsToManyFilter;
use Leeto\MoonShine\Attributes\SearchUsingFullText;

class ProductResource extends Resource
{
    public static string $model = Product::class;

    public static string $title = 'Продукты';
    public static int $itemsPerPage = 10;
    public static array $with = [
        'brand',
        'categories',
        'properties',
        'optionValues'
    ];

    public function fields(): array
    {
        return [
            Tabs::make([
                Tab::make('Основное', [
                    ID::make()->sortable(),
                    Text::make('Заголовок', 'title')
                        ->showOnExport(),
                    // todo fix price
                    Text::make('Цена', 'price')
                        ->showOnExport,
                    Number::make('Количество', 'quantity')
                        ->showOnExport()
                        ->sortable(),
                    Image::make('Изображение', 'thumbnail')
                        ->disk('images')
                        ->dir('products'),
                    SwitchBoolean::make('Показывать на главной', 'on_main_page'),
                    Number::make('Сортировка', 'sorting')
                        ->min(1)
                        ->max(999)
                        ->hideOnIndex(),
                    Text::make('Описание', 'text')
                        ->hideOnIndex()
                ]),

                Tab::make('Бренд', [
                    BelongsTo::make('Бренд', 'brand')
                        ->showOnExport()
                        ->sortable(),
                ]),

                Tab::make('Категории', [
                    BelongsToMany::make('Категории', 'categories')
                        ->showOnExport(),
                ]),

                Tab::make('Свойства', [
                    BelongsToMany::make('Свойства товара', 'properties', resource: 'title')
                        ->showOnExport()
                        ->hideOnIndex()
                        ->fields([
                            Text::make('Значение свойства', 'value')
                        ])
                ]),

                Tab::make('Опции', [
                    BelongsToMany::make('Опции товара', 'optionValues', resource: 'title')
                        ->showOnExport()
                        ->hideOnIndex()
                        ->fields([
                            Text::make('Значение опции', 'value')
                        ])
                ]),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    #[SearchUsingFullText(['title', 'text'])]
    public function search(): array
    {
        return [
            'id',
        ];
    }

    public function filters(): array
    {
        return [
            BelongsToFilter::make('brand')
                ->searchable(),
            BelongsToManyFilter::make('categories')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
            ExportAction::make('Export')
        ];
    }
}
