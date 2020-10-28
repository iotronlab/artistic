<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute\Attribute;

class AttributeGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'attribute_groups';

    protected $fillable = ['name', 'position'];

    /**
     * Get the attributes that owns the attribute group.
     */
    public function custom_attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_group_mappings')
            ->withPivot('position')
            ->orderBy('pivot_position', 'asc');
    }
}
