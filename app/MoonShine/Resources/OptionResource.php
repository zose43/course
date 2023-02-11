<?php

namespace App\MoonShine\Resources;

use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Fields\Text;
use Domain\Product\Models\Option;
use Leeto\MoonShine\Decorations\Block;
use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Actions\FiltersAction;

class OptionResource extends Resource
{
    public static string $model = Option::class;

    public static string $title = 'Торговые опции продукта';

    public function fields(): array
    {
        return [
            Block::make('form-container', [
                ID::make()->sortable(),
                Text::make('Заголовок', 'title')
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
