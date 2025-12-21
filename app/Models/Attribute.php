<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * An option belongs to a variation (e.g., Red belongs to Color).
     */
    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

    /**
     * An option can belong to many product variants.
     */
    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_attributes');
    }
}
