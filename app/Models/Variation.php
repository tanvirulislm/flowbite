<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * A variation has many options (e.g., Color has Red, Blue, etc.).
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
