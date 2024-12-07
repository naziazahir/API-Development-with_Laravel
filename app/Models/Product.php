<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the attributes that are mass-assignable
    protected $fillable = [
        'name',        // For example: name of the product
        'price',       // For example: price of the product
        'description', // For example: description of the product
        'quantity',    // For example: stock quantity
    ];

    // You can also define guarded attributes if needed (optional)
    // protected $guarded = ['id']; // Prevent mass assignment on specific fields
}

