<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryModel extends Model
{
    protected $table = 'categories';

    public $timestamps = true;
 
    protected $fillable = [
        'category_name', 
        'category_url' 
    ]; 
}
