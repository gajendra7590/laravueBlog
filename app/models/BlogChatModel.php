<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BlogChatModel extends Model
{
    protected $table = 'blogchat';

    public $timestamps = true;
 
    protected $fillable = [
        'blog_id', 
        'userid',
        'message' 
    ];
}
