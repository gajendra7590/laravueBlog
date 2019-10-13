<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{ 
    protected $table = 'blogs';

    public $timestamps = true;
 
    protected $fillable = [
        'blog_name', 
        'blog_title',
        'blog_desc', 
        'blog_url',
        'blog_user',
        'blog_category',
        'blog_image', 
        'blog_location', 
    ];

    protected $attributes = [
        'blog_name' => null, 
        'blog_title' => null,
        'blog_desc' => null, 
        'blog_url' => null, 
        'blog_category' => null,
        'blog_image' => null, 
        'blog_location' => null, 
     ]; 

    
    public function category(){ 
        return $this->hasOne('App\models\BlogCategoryModel','id','blog_category');
    }

    public function user(){ 
        return $this->hasOne('App\User','id','blog_user');
    }
 
}
