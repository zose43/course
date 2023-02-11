<?php

namespace App\MoonShine\Resources;

use Leeto\MoonShine\Fields\ID;
use Domain\Catalog\Models\Brand;
use Leeto\MoonShine\Fields\Text;
use Leeto\MoonShine\Fields\Image;
use Leeto\MoonShine\Fields\Number;
use Leeto\MoonShine\Decorations\Block;
use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Fields\SwitchBoolean;
use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Actions\FiltersAction;

class BrandResource extends Resource
{
    public static string $model = Brand::class;

    public static string $title = 'Бренды';
    public string $titleField = 'title';

    public function fields(): array
    {
        return [
            Block::make('form-container', [
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')
                    ->showOnExport(),
                Image::make('Изображение', 'thumbnail')
                    ->disk('images')
                    ->dir('brands'),
                SwitchBoolean::make('Показывать на главной', 'on_main_page'),
                Number::make('Сортировка', 'sorting')
                    ->min(1)
                    ->max(999)
                    ->showOnExport()
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return [
            'id',
            'title'
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
            ExportAction::make('Export')
        ];
    }
}
