<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FaqModel extends Model
{
    protected $table = 'faq';

    public $timestamps = true;
 
    protected $fillable = [
        'faq_title', 
        'faq_short_desc',
        'faq_desc' 
    ]; 
}
