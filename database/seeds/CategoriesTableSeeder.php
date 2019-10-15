<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\models\BlogCategoryModel as Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = array(
            ['category_name'=>'Academics','category_url'=>'academics'], 
            ['category_name'=>'Education','category_url'=>'education'],
            ['category_name'=>'Science & Technolgoy','category_url'=>'science-and-technolgoy'],
            ['category_name'=>'Sports','category_url'=>'sports'],
            ['category_name'=>'Social Media','category_url'=>'social-media'],
            ['category_name'=>'Indian Politics','category_url'=>'indian-politics'] 
        );

        Category::truncate();
        foreach($category as $cat){
            $checkCategory = Category::where(['category_name'=>$cat['category_name']])->first();
            if($checkCategory==null){
                Category::create($cat); 
            } 
        }
    }
}
