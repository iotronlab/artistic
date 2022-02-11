<?php

namespace App\Orchid\Layouts\Catalog\Product;

use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
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

    protected function striped(): bool
    {
        return true;
    }
    protected function onEachSide(): int
    {
        return $this->query->get('onEachSide');
    }


    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('name')->render(function ($product) {
                return Link::make($product->flat->name)
                    ->target('_blank')
//                    ->route('platform.catalog.product.'.Str::lower($product->type).'.edit',$product)
                    ->href(config('app.client_url').'/catalog/product/'.$product->flat->name);
            })->sort(),
            TD::make('type')->sort()->filter(Input::make()),
//            TD::make('sku')->sort(),

            // Deep Drive Needed
//            TD::make('price')->render(function ($product) {
//                $money = $product->flat->price->instance();
//                return dd($money->amount());
//            })->sort(),

            // Json Attribute Returning
//            TD::make('attribute_family_id')->render(function ($product) {
//                return $product->attribute_family;
//            })->sort(),



            TD::make('popularity'),
            TD::make('status')->render(function ($product) {
                return ($product->status) ? '<b class="text-success">Active</b>':'<b class="text-danger">DeActive</b>';
            })->sort(),

            TD::make('vendor')->render(function ($product) {
                return $product->vendor->display_name;
            })->sort(),
            TD::make('view_count')->sort(),


            TD::make('Action')->render(function ($product) {
                return DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        // All Edit
                        Link::make(__('Edit'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        // Step By Step Edit
                        Link::make(__('General Detail'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        Link::make(__('Shipping Detail'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        Link::make(__('Inventory Detail'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        Link::make(__('Attached Media'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        Link::make(__('SEO Detail'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),
                        Link::make(__('Linked Products'))
                            ->route('platform.catalog.product.'.Str::lower($product->type).'.edit', $product)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->method('remove')
                            ->icon('trash')
                            ->confirm(__('Are you sure you want to delete the product?'))
                            ->parameters([
                                'id' => $product->id,
                            ]),
                    ]);
            })->sort(),




        ];
    }
}
