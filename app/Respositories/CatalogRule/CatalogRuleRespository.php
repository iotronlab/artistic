<?php

namespace App\Repositories\CatalogRule;

use Illuminate\Container\Container as App;
use App\Models\CatalogRule\CatalogRule;
use App\Repositories\Attribute\AttributeFamilyRepository;
use App\Repositories\Attribute\AttributeRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Eloquent\Repository;
use App\Repositories\Tax\TaxCategoryRepository;

class CatalogRuleRepository extends Repository
{

    protected $attributeFamilyRepository;

    protected $attributeRepository;

    protected $categoryRepository;

    protected $taxCategoryRepository;


    public function __construct(
        AttributeFamilyRepository $attributeFamilyRepository,
        AttributeRepository $attributeRepository,
        CategoryRepository $categoryRepository,
        TaxCategoryRepository $taxCategoryRepository,
        App $app
    ) {
        $this->attributeFamilyRepository = $attributeFamilyRepository;

        $this->attributeRepository = $attributeRepository;

        $this->categoryRepository = $categoryRepository;

        $this->taxCategoryRepository = $taxCategoryRepository;
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return CatalogRule::class;
    }
    /**
     * @param  array  $data
     * @return \CatalogRule\Contracts\CatalogRule
     */
    public function create(array $data)
    {
        $data['status'] = !isset($data['status']) ? 0 : 1;

        $catalogRule = parent::create($data);
        $catalogRule->customer_groups()->sync($data['customer_groups']);

        return $catalogRule;
    }

    // /**
    //  * Returns attributes for catalog rule conditions
    //  *
    //  * @return array
    //  */
    // public function getConditionAttributes()
    // {
    //     $attributes = [
    //         [
    //             'key'      => 'product',
    //             'label'    => trans('admin::app.promotions.catalog-rules.product-attribute'),
    //             'children' => [
    //                 [
    //                     'key'     => 'product|category_ids',
    //                     'type'    => 'multiselect',
    //                     'label'   => trans('admin::app.promotions.catalog-rules.categories'),
    //                     'options' => $this->categoryRepository->getCategoryTree(),
    //                 ], [
    //                     'key'     => 'product|attribute_family_id',
    //                     'type'    => 'select',
    //                     'label'   => trans('admin::app.promotions.catalog-rules.attribute_family'),
    //                     'options' => $this->getAttributeFamilies(),
    //                 ]
    //             ]
    //         ]
    //     ];

    //     foreach ($this->attributeRepository->findWhereNotIn('type', ['textarea', 'image', 'file']) as $attribute) {
    //         $attributeType = $attribute->type;

    //         if ($attribute->code == 'tax_category_id') {
    //             $options = $this->getTaxCategories();
    //         } else {
    //             if ($attribute->type === 'select') {
    //                 $options = $attribute->options()->orderBy('sort_order')->get();
    //             } else {
    //                 $options = $attribute->options;
    //             }
    //         }

    //         if ($attribute->validation == 'decimal')
    //             $attributeType = 'decimal';

    //         if ($attribute->validation == 'numeric')
    //             $attributeType = 'integer';

    //         $attributes[0]['children'][] = [
    //             'key'     => 'product|' . $attribute->code,
    //             'type'    => $attribute->type,
    //             'label'   => $attribute->name,
    //             'options' => $options,
    //         ];
    //     }

    //     return $attributes;
    // }
    // /**
    //  * Returns all tax categories
    //  *
    //  * @return array
    //  */
    // public function getTaxCategories()
    // {
    //     $taxCategories = [];

    //     foreach ($this->taxCategoryRepository->all() as $taxCategory) {
    //         $taxCategories[] = [
    //             'id'         => $taxCategory->id,
    //             'admin_name' => $taxCategory->name,
    //         ];
    //     }

    //     return $taxCategories;
    // }

    // /**
    //  * Returns all attribute families
    //  *
    //  * @return array
    //  */
    // public function getAttributeFamilies()
    // {
    //     $attributeFamilies = [];

    //     foreach ($this->attributeFamilyRepository->all() as $attributeFamily) {
    //         $attributeFamilies[] = [
    //             'id'         => $attributeFamily->id,
    //             'admin_name' => $attributeFamily->name,
    //         ];
    //     }

    //     return $attributeFamilies;
    // }
}
