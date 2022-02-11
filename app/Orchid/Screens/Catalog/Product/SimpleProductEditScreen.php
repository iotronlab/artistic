<?php

namespace App\Orchid\Screens\Catalog\Product;

use App\Models\Product\Product;
use App\Orchid\Layouts\Catalog\Product\Simple\DescriptionEditLayout;
use App\Orchid\Layouts\Catalog\Product\Simple\GeneralEditLayout;
use App\Orchid\Layouts\Catalog\Product\Simple\SEOProductEditLayout;
use App\Repositories\Product\ProductRepository;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SimpleProductEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SimpleProductEditScreen';

    /**
     * Query data.
     *
     * @param Product $product
     * @return array
     */
    public function query(Product $product): array
    {
        if ($product->type == 'simple') {
            $product->load('categories', 'flat', 'vendor', 'stocks', 'stocks.address');
        }
        //dd($product);
        $this->exists = $product->exists;
        return [
            'product' => $product,
        ];
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


            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),

            // Modals
            ModalToggle::make('New Category')
                ->modal('asyncCategoryModal')
                ->method('createCategory')
                ->icon('layers'),
            ModalToggle::make('New Attribute')
                ->modal('asyncCategoryModal')
                ->method('createCategory')
                ->icon('layers'),
            ModalToggle::make('New Attribute Family')
                ->modal('asyncCategoryModal')
                ->method('createCategory')
                ->icon('layers'),
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
                Select::make('type')->title('Product Type')->required(),
                Select::make('attribute_family')->title('Attribute Family')->required(),
                Input::make('sku')->title('SKU')->required(),
            ])->canSee(!$this->exists),

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
