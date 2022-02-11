<?php

namespace App\Orchid\Screens\Catalog\Product;

use App\Http\Controllers\api\Attribute\AttributeController;
use App\Http\Resources\Attribute\AttributeFamilyIndex;
use App\Http\Resources\Attribute\AttributeFamilyResource;
use App\Models\Attribute\AttributeFamily;
use App\Models\Product\Product;
use App\Orchid\Layouts\Catalog\Product\Wizard\CommonLayout;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Attribute\AttributeRepository;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Contracts\Cardable;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ProductWizardScreen extends Screen
{
    public const SIMPLE = 'simple';
    public const CONFIGURABLE = 'configurable';
    public const Bundle = 'bundle';

    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Product Wizard';
    public $description = 'Start Product Creation';
    /**
     * @var mixed
     */
    private string $formType = '';
    private bool $configForm = false;
    private bool $getForm = false;
    private $request;
    /**
     * @var mixed|string
     */
    private $type;
    /**
     * @var mixed|string
     */
    private $sku;
    /**
     * @var mixed|string
     */
    private $family_id;

    /**
     * Query data.
     *
     * @param Request $request
     * @param Product $product
     * @param AttributeFamilyRepository $attributeFamilyRepository
     * @return array
     */
    public function query(Request $request,Product $product,AttributeRepository $attributeRepository,AttributeFamilyRepository $attributeFamilyRepository): array
    {

        $this->repository = $attributeRepository;
        $this->attributeFamilyRepository = $attributeFamilyRepository;

        $this->request = $request;
        $this->exists = $product->exists;
        $this->type = $request->type ?? '';
        $this->sku = $request->sku ?? '';
        $this->family_id = $request->attribute_family_id ?? '';
        if(!empty($this->type))
        {

            $this->description = 'Continue Product Creation';
            $this->formType = $request->type;
            $this->getForm = true;
            if($this->formType === self::CONFIGURABLE)
            {
                $this->configForm = true;
            }
        }

        //dd(new AttributeFamilyResource($this->attributeFamilyRepository->find(2)));

        $this->family = AttributeFamily::with('attribute_groups')->find(2);
      dd($this->family);
        $this->fieldsTypes = [];
       // dd($this->family);
        foreach ($this->family->attribute_groups as $family)
        {


            $this->fieldsTypes [$family->position] = $field;
        }






        return [
            'product' => $product,
//            'attribute' => AttributeFamily::find($this->family_id),
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
            Button::make('Start')
                ->method('confirmMyAction')
                ->canSee(empty($this->formType)),
            Button::make('Continue')
                ->method('confirmMyAction')
                ->canSee(!empty($this->formType))

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
                Select::make('type')->options([
                    self::SIMPLE => 'Simple',
                    self::CONFIGURABLE => 'Configurable',
                    self::Bundle => 'Bundle'
                ])->value($this->type)
                ->title('Select Which Type Of Product You Wish To Create'),
                Select::make('attribute_family_id')
                    ->title('Attribute Family')
                    ->fromModel(AttributeFamily::class,'name','id')
                    ->value($this->family_id),
                Input::make('sku')
                    ->title('SKU')
                    ->required()
                    ->value($this->sku)
                    ->title('Set Unique SKU'),
            ])->title('General Information')->canSee(!$this->exists),

//            CommonLayout::class,



           // Layout::rows($this->fieldsTypes),




        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function confirmMyAction(Request $request)
    {

       if($request->type === self::CONFIGURABLE)
       {
           $url = back()->getTargetUrl() . '?type=' . $request->type . '&sku=' . $request->sku. '&attribute_family_id='.$request->attribute_family_id;
           return  redirect()->to($url);
       }else{
           // Simple Case

       }



    }



}
