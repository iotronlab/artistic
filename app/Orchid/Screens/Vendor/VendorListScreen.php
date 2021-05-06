<?php

namespace App\Orchid\Screens\Vendor;

use App\Orchid\Layouts\Vendor\VendorListLayout;
use App\Models\Vendor\Vendor;
use Orchid\Screen\Actions\Link;

use Orchid\Screen\Screen;

class VendorListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Vendors';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'All vendor details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        $vendors = Vendor::filters()->defaultSort('updated_at', 'desc')->paginate(10);
        return [
            'vendors' => $vendors
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.vendor.edit')
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
            VendorListLayout::class
        ];
    }
}
