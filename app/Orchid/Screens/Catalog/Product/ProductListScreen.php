<?php

namespace App\Orchid\Screens\Catalog\Product;

use App\Orchid\Layouts\Catalog\Product\ProductListLayout;
use App\Repositories\Product\ProductRepository;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

/**
 * @property $exists;
 * @property $name;
 *
 */
class ProductListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ProductListScreen';

    /**
     * Query data.
     *
     * @param ProductRepository $productRepository
     * @return array
     */
    public function query(ProductRepository $productRepository): array
    {
        //$products = $productRepository->getAll()->where('type','simple');
        //dd($products->forpage($products->total()/$product->perPage(),$product->perPage());
        $products = $productRepository->getAll();
        //dd($products->onEachSide);
        return [
            'product' =>$products,
            'onEachSide'=> $products->onEachSide,
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
            Link::make('Create')->route('platform.catalog.product.wizard'),
            Link::make('Create Simple')->route('platform.catalog.product.simple.edit'),
            Link::make('Create Configurable')->route('platform.catalog.product.configurable.edit'),
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
//            Layout::rows([
//                DropDown::make()
//                    ->icon('options-vertical')
//                    ->list([
//                        Link::make('All Channel')
//                            ->route('platform.catalog.product.list',['filtering'=>'all_channel'])
//                            ->icon('pencil'),
//                        Link::make('Default')
//                            ->icon('bag')
//                            ->route('platform.catalog.product.list',['filtering'=>'_default']),
//                    ])
//            ]),
            ProductListLayout::class,
        ];
    }
}
