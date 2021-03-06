<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Attribute\AttributeOption;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';

    protected $fillable = [
        'code',
        'admin_name',
        'type',
        'position',
        'validation',
        'is_filterable',
        'is_configurable',
        'is_visible_on_front',
        'is_required',
        'is_user_defined'
    ];

    /**
     * Get the options.
     */
    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function scopeFilterableAttributes($query)
    {
        return $query->where('is_filterable', 1)->orderBy('position');
    }
}
