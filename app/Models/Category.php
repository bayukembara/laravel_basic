<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    // * this function is used for to make a relationship between the user table and category table
    public function user()
    {
        // & ORM
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
