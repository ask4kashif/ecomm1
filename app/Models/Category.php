<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'name','slug','description','image'
    ];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
