<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute\AttributeGroup;

class AttributeFamily extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'attribute_families';

    protected $fillable = ['code', 'name'];

    /**
     * Get all of the attributes for the attribute groups.
     */
    public function custom_attributes()
    {
        return Attribute::join('attribute_group_mappings', 'attributes.id', '=', 'attribute_group_mappings.attribute_id')
        ->join('attribute_groups', 'attribute_group_mappings.attribute_group_id', '=', 'attribute_groups.id')
        ->join('attribute_families', 'attribute_groups.attribute_family_id', '=', 'attribute_families.id')
        ->where('attribute_families.id', $this->id)
            ->select('attributes.*');
    }

    /**
     * Get all of the attributes for the attribute groups.
     */
    public function getCustomAttributesAttribute()
    {
        return $this->custom_attributes()->get();
    }

    /**
     * Get all of the attribute groups.
     */
    public function attribute_groups()
    {
        return $this->hasMany(AttributeGroup::class)->orderBy('position');
    }

    /**
     * Get all of the attributes for the attribute groups.
     */
    public function getConfigurableAttributesAttribute()
    {
        return $this->custom_attributes()->where('attributes.is_configurable', 1)->where('attributes.type', 'select')->get();
    }

}
