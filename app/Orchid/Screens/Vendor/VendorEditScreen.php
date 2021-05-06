<?php

namespace App\Orchid\Screens\Vendor;

use App\Models\User;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Password;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;


class VendorEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create Vendor.';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Vendor details.';

    /**
     * Query data.
     *
     * @return array
     */

    public $exists = false;
    public function query(Vendor $vendor): array
    {
        $this->exists = $vendor->exists;

        if ($this->exists) {
            $this->name = 'Edit vendor details.';
        }

        return [
            'vendor' => $vendor
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
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
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
            Layout::rows([
                Input::make('vendor.display_name')
                    ->title('Display Name')
                    ->placeholder('Name to be displayed on webapp')
                    ->help('Name for public profile.')->required(),

                Input::make('vendor.contact_name')
                    ->title('Contact Name')
                    ->placeholder('Name to be use for billing')
                    ->help('Name in government documents.')->required(),

                Input::make('vendor.email')
                    ->type('email')
                    ->title('Email')
                    ->placeholder('Official Email')
                    ->help('Email to be use for contacting.')->required(),

                Input::make('vendor.url')
                    ->title('Profile url')
                    ->placeholder('Profile Url in webapp')
                    ->help('Unique artify handle.')->required(),

                Input::make('vendor.contact')
                    ->title('Contact')

                    ->placeholder('Vendor Phone number')->required(),

                Input::make('vendor.password')
                    ->title('Password')
                    ->placeholder('Profile password')
                    ->required(),

                CheckBox::make('vendor.status')
                    ->title('Vendor Status')
                    ->placeholder('Set Vendor Status')->sendTrueOrFalse(),

                TextArea::make('vendor.bio')
                    ->title('Bio')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Vendor Bio'),

                // Relation::make('post.author')
                //     ->title('Author')
                //     ->fromModel(User::class, 'name'),



            ])
        ];
    }

    public function createOrUpdate(Vendor $vendor, Request $request)
    {
        $vendor->fill($request->get('vendor'))->save();

        Alert::info('You have successfully saved vendor details!');

        return redirect()->route('platform.vendor.list');
    }

    public function remove(Vendor $vendor)
    {
        $vendor->delete();

        Alert::info('Vendor details deleted!');
        return redirect()->route('platform.vendor.list');
    }
}
