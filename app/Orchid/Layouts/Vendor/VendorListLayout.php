<?php

namespace App\Orchid\Layouts\Vendor;

use App\Models\Vendor\Vendor;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class VendorListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'vendors';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('email', 'Email')
                ->render(function (Vendor $vendor) {
                    return Link::make($vendor->email)
                        ->route('platform.vendor.edit', $vendor);
                })->filter(TD::FILTER_TEXT),

            TD::make('url', 'Url')
                ->render(function (Vendor $vendor) {
                    return Link::make($vendor->url)
                        ->route('platform.vendor.edit', $vendor);
                })->filter(TD::FILTER_TEXT),
            TD::make('display_name', 'Disp Name')->filter(TD::FILTER_TEXT),
            TD::make('contact_name', 'Contact Name')->filter(TD::FILTER_TEXT)->sort(),
            TD::make('contact', 'Contact')->filter(TD::FILTER_TEXT),
            TD::make('status', 'Status')->filter(TD::FILTER_TEXT),
            TD::make('created_at', 'Created')->filter(TD::FILTER_DATE)->sort(),
            TD::make('updated_at', 'Last edit')->filter(TD::FILTER_DATE)->sort()
                ->render(function ($vendor) {
                    if ($vendor->updated_at) {
                        $date = $vendor->updated_at->toDayDateTimeString();
                    } else {
                        $date = 'n/a';
                    }
                    return $date;
                }),
        ];
    }
}
