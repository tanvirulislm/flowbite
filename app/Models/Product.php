<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand that the product belongs to.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the product variants for the product.
     * This is the core relationship to your sellable SKUs.
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get all unique variation options for the product via its variants.
     * This is a "has many through" or "has many" relationship depending on your needs.
     * I've added a query scope to make it easier to get distinct options.
     */
    public function getAvailableAttributes()
    {
        // This query finds all attribute options that are linked to any of this product's variants
        return Attribute::whereIn('id', function ($query) {
            $query->select('attribute_id')
                ->from('product_attribute_options')
                ->whereIn('product_variant_id', $this->variants->pluck('id'))
                ->groupBy('attribute_id');
        })->get();
    }
}
