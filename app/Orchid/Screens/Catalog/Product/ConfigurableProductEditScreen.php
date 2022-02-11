<?php

namespace App\Orchid\Screens\Catalog\Product;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Catalog\Product\Configurable\GeneralEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\DescriptionEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\InventoryEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\LinkedProductEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\MediaEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\SEOProductEditLayout;
use App\Orchid\Layouts\Catalog\Product\Configurable\ShippingEditLayout;

class ConfigurableProductEditScreen extends Screen
{


    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ConfigurableProductEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product,Request $request): array
    {
        $this->steps = true;
        //dd($request);
        $this->exists = $product->exists;
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('bag')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Confirm')
                ->icon('bag')
                ->method('createOrUpdate')
                ->canSee($this->exists),


            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [

            // First Step Creation
            Layout::rows([
                Select::make('type')
                    ->title('Product Type')
                    ->options([
                        'simple'   => 'Simple',
                        'configurable' => 'Configurable',
                        'configurable' => 'Configurable',
                    ])
                    ->required(),
                Select::make('attribute_family')->title('Attribute Family')->required(),
                Input::make('sku')->title('SKU')->required(),
            ])->canSee(!$this->exists),

            Layout::rows([
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
            ])->title('Configurable Attributes')->canSee($this->exists),




            // Edit Mode




            // Accordian Mode

            Layout::accordion([
                'General Information' => [
                    GeneralEditLayout::class,
                ],
                'Description'      => [
                    DescriptionEditLayout::class,
                ],
                'Meta Description'      => [
                    SEOProductEditLayout::class,
                ],
                'Inventory Detail'      => [
                    SEOProductEditLayout::class,
                ],
                'Shipping Detail'      => [
                    SEOProductEditLayout::class,
                ],
                'Media Attachment'      => [
                    SEOProductEditLayout::class,
                ],
                'Linked Products'      => [
                    SEOProductEditLayout::class,
                ],
            ])->canSee($this->exists),





        ];
    }
}
