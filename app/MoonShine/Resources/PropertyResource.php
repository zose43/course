<?php

namespace App\MoonShine\Resources;

use Leeto\MoonShine\Fields\ID;
use Leeto\MoonShine\Fields\Text;
use Domain\Product\Models\Property;
use Leeto\MoonShine\Decorations\Block;
use Illuminate\Database\Eloquent\Model;
use Leeto\MoonShine\Resources\Resource;
use Leeto\MoonShine\Actions\ExportAction;
use Leeto\MoonShine\Actions\FiltersAction;

class PropertyResource extends Resource
{
    public static string $model = Property::class;

    public static string $title = 'Свойства продукта';

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
