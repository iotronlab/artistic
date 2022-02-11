<?php

namespace App\Orchid\Layouts\Catalog\Product\Simple;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SEOProductEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = '';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('Meta Title')->title('Meta Title'),
            TextArea::make('Meta Title')->title('Meta Keywords'),
            TextArea::make('Meta Title')->title('Meta Description'),

        ];
    }
}
