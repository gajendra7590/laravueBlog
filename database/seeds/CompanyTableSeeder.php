<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\models\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        Company::create([
            'company_name'=>'LaraVue Blog',
            'company_email'=>'support@laravueblog.com',
            'company_address'=>'120,Laravue blog Above Test Building,Test Test 452012',
            'company_phone'=>'1234567890',
            'company_phone2'=>'1234567890',
            'facebook'=>null,
            'twitter'=>null,
            'google'=>null,
            'instagram'=>null,
            'linkedin'=>null,
            'pintrest'=>null,
            'default'=>'1'
        ]);  
    }
}
