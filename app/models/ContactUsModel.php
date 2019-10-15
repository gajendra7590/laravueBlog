<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContactUsModel extends Model
{
    protected $table = 'contactus';

    public $timestamps = true;
 
    protected $fillable = [
        'contact_subject', 
        'contact_fullname',
        'contact_email', 
        'contact_phone',
        'contact_message', 
        'contact_company' 
    ];
}
