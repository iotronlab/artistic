<?php

namespace App\Models\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'attribute_options';
    protected $fillable = [
        'admin_name',
        'swatch_value',
        'sort_order',
        'attribute_id',
    ];

    /**
     * Get the attribute that owns the attribute option.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
