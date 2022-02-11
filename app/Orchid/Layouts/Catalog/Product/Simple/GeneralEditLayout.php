<?php

namespace App\Orchid\Layouts\Catalog\Product\Simple;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GeneralEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'product';
//    protected $title = 'General Information';

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
     * @return array
     */
    protected function fields(): array
    {
        return [
                Group::make([
                    Input::make('name')->title('Name')->placeholder('[default - en]')->required(),
                    Input::make('sku')->title('SKU')->required(),
                ]),
                Group::make([
                    Input::make('number')->title('Product Number'),
                    Input::make('url_key')->title('URL Key')->required(),
                    Select::make('tax_category')->title('Tax Category'),
                ]),


                Group::make([
                    Switcher::make('new')->title('New Product'),
                    Switcher::make('featured')->title('Featured'),
                    Switcher::make('visible_individually')->title('Visible Individually'),
                    Switcher::make('guest_checkout')->title('Guest Checkout'),
                    Switcher::make('status')->title('Status'),
                ]),

                Group::make([
                    Select::make('color')
                        ->title('Color')
                        ->options([
                            'red'   => 'Red',
                            'green' => 'Green',
                            'yellow' => 'Yellow',
                            'blue' => 'Blue',
                            'black' => 'Black',
                            'white' => 'White',
                        ]),
                    Select::make('size')
                        ->title('Size')
                        ->options([
                            's'   => 'S',
                            'm' => 'M',
                            'l' => 'L',
                            'xl' => 'XL',
                        ]),
                    Select::make('brand')
                        ->title('Brand')
                        ->options([
                            'index'   => 'Set Relation',
                        ]),
                ]),
            ];
    }
}
