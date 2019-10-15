<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company'; 
    public $timestamps = true; 
    protected $fillable = [
        'company_name', 
        'company_email',
        'company_address', 
        'company_phone',
        'company_phone2',
        'facebook',
        'twitter', 
        'google', 
        'instagram', 
        'linkedin',
        'pintrest', 
        'default',
    ];

    protected $attributes = [
        'company_name' => null, 
        'company_email' => null,
        'company_address' => null, 
        'company_phone' => null, 
        'company_phone2' => null,
        'facebook' => null, 
        'twitter' => null, 
        'google' => null, 
        'instagram' => null,
        'linkedin' => null, 
        'pintrest' => null, 
     ]; 
}
