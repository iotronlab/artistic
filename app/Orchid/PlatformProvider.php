<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            // Dashboard
            Menu::make('Dashboard')
//                ->title('Dashboard Section')
                ->icon('monitor'),
            // Sales
            Menu::make('Sales')
//                ->title('Sales Section')
                ->icon('chart')
                ->list([
                    Menu::make('Orders')->icon('bag'),
                    Menu::make('Shipments')->icon('bag'),
                    Menu::make('Invoices')->icon('bag'),
                    Menu::make('Refunds')->icon('bag'),
                    Menu::make('Transactions')->icon('code')
                ]),
            // Catalog
            Menu::make('Catalog')
//                ->title('Catalog Section')
                ->icon('code')
                ->list([
                    Menu::make('Products')
                        ->icon('bag')
//                        ->title('Product Section')
                        ->list([
                            Menu::make('Simple')->icon('bag'),
                            Menu::make('Configurable')->icon('bag')
                        ]),
                    Menu::make('Categories')->icon('heart'),
                    Menu::make('Attributes')->icon('heart'),
                    Menu::make('Attribute Families')->icon('heart'),
                ]),
            // Customers
            Menu::make('Customers')
//                ->title('Customers Section')
                ->icon('user')
                ->list([
                    Menu::make('Customers')->icon('user'),
                    Menu::make('Groups')->icon('bag'),
                    Menu::make('Reviews')->icon('note'),
                ]),
            // SEO
            Menu::make('SEO')
//                ->title('SEO Section')
                ->icon('config')
                ->list([
                    Menu::make('Meta Data')->icon('note'),
                    Menu::make('Header Content')->icon('config')
                ]),

            // Promotions
            Menu::make('Promotions')
//                ->title('Promotion Section')
                ->icon('heart')
                ->list([
                    Menu::make('Promotions')
                        ->icon('heart')
                        ->list([
                            Menu::make('Catalog Rules')->icon('bag'),
                            Menu::make('Cart Rules')->icon('bag'),
                        ]),

                    Menu::make('Email Marketing')
                        ->icon('email')
                        ->list([
                            Menu::make('Email Templates')->icon('bag'),
                            Menu::make('Events')->icon('bag'),
                            Menu::make('Campaigns')->icon('bag'),
                            Menu::make('Newsletter Subscriptions')->icon('bag'),
                        ]),
                ]),
            // CMS
            Menu::make('CMS')
//                ->title('CMS Section')
                ->icon('monitor')
                ->list([
                    Menu::make('Pages')->icon('bag'),
                ]),

            // Settings
            Menu::make('Settings')
                ->icon('config')
//                ->title('Setting Section')
                ->list([
                    Menu::make('Locales')->icon('heart'),
                    Menu::make('Currencies')->icon('heart'),
                    Menu::make('Exchange Rates')->icon('heart'),
                    Menu::make('Inventory Sources')->icon('bag'),
                    Menu::make('Channels')->icon('heart'),
                    Menu::make('Users')->icon('user'),
                    Menu::make('Sliders')->icon('config'),
                    Menu::make('Taxes')->icon('bag'),
                ]),

            // Configure
            Menu::make('Configure')
                ->icon('config')
//                ->title('Configure Section')
                ->list([
                    Menu::make('General')->icon('bag'),
                    Menu::make('Catalog')->icon('bag'),
                    Menu::make('Customer')->icon('bag'),
                    Menu::make('Sales')->icon('bag'),
                    Menu::make('Email')->icon('bag'),
                    Menu::make('Taxes')->icon('bag'),
                ]),




//
//
//
//
//
//
//            Menu::make('Example screen')
//                ->icon('monitor')
//                ->route('platform.example')
//                ->title('Navigation')
//                ->badge(function () {
//                    return 6;
//                }),
//
//            Menu::make('Dropdown menu')
//                ->icon('code')
//                ->list([
//                    Menu::make('Sub element item 1')->icon('bag'),
//                    Menu::make('Sub element item 2')->icon('heart'),
//                ]),
//
//            Menu::make('Basic Elements')
//                ->title('Form controls')
//                ->icon('note')
//                ->route('platform.example.fields'),
//
//            Menu::make('Advanced Elements')
//                ->icon('briefcase')
//                ->route('platform.example.advanced'),
//
//            Menu::make('Text Editors')
//                ->icon('list')
//                ->route('platform.example.editors'),
//
//            Menu::make('Overview layouts')
//                ->title('Layouts')
//                ->icon('layers')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Chart tools')
//                ->icon('bar-chart')
//                ->route('platform.example.charts'),
//
//            Menu::make('Cards')
//                ->icon('grid')
//                ->route('platform.example.cards')
//                ->divider(),
//
//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('docs')
//                ->url('https://orchid.software/en/docs'),
//
//            Menu::make('Changelog')
//                ->icon('shuffle')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(function () {
//                    return Dashboard::version();
//                }, Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
