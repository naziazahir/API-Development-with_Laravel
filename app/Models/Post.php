<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Add the attributes you want to allow for mass assignment
    protected $fillable = [
        'title',
        'body' // Add other fields if necessary
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
