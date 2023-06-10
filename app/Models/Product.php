<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'SKU',
        'quantity',
        'sale_price',
    ];

    /**
     * Define a many-to-many relationship with the Category model.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * Define a one-to-many relationship with the Vendor model.
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Define any other custom methods or additional relationships here.
     */
    
    // Example method: Get the total price of the product based on quantity and sale price
    public function getTotalPrice()
    {
        return $this->quantity * $this->sale_price;
    }
}
