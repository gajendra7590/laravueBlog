<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    protected $table = 'contactus';

    public $timestamps = true;
 
    protected $fillable = [
        'contact_name', 
        'contact_email',
        'contact_title', 
        'contact_note' 
    ];
}
