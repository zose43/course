<?php

namespace Domain\Product\QueryBuilders;

use Illuminate\Pipeline\Pipeline;
use Domain\Product\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class ProductQueryBuilder extends Builder
{
    public function sorted(): self
    {
        return $this->when(request('sort'), function (Builder $q) {
            $column = request()?->str('sort');

            if ($column->contains(['price', 'title'])) {
                $direction = $column->contains('-') ? 'DESC' : 'ASC';
                $q->orderBy((string)$column->remove('-'), $direction);
            }
        });
    }

    public function filtered(): Builder
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();
    }

    public function withCategory(?Category $category): self
    {
        // todo fx domain dependency
        return $this->when($category?->exists, function (Builder $query) use (&$category) {
            $query->whereRelation(
                'categories',
                'categories.id',
                '=',
                $category->id);
        });
    }

    public function search(): self
    {
        return $this->select(['thumbnail', 'title', 'price', 'slug', 'json_properties'])
            ->when(request('s'), function (Builder $query) {
                $query->whereFullText(['title', 'text'], request('s'));
            });
    }

    public function viewed(Product $product, array $items): self
    {
        return $this->select(['thumbnail', 'title', 'price', 'slug'])
            ->where(function (Builder $q) use (&$product, $items) {
                $q->whereIn('id', $items)
                    ->whereNot('id', $product->id);
            })->limit(4);
    }

    public function homePage(): self
    {
        return $this->where('on_main_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }
}