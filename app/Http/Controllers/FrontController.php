<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// All Models
use App\models\Blogs;
use App\models\BlogCategoryModel as Cat;
use App\User;

use Auth;
use Validator;

class FrontController extends Controller
{
    /**
     * Get Categories List for Front Menus
     */
    public function categories(){ 

        $getCat = Cat::select('id','category_name','category_url')->get(); 
         return response()->json([
             'status'=>true,
             'data'=> ($getCat!=null)?$getCat->toArray():array()
         ]);
    }

    /**
     * Most Popular 4 sidebar
     */
    public function top4Blog(){ 
        $getBlogs = Blogs::select([
                      'id','blog_name','blog_title','blog_url',
                       'blog_user','blog_category','blog_image','created_at'
                    ])->take(4)->get();
        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
        ]);  
    } 

    /**
     * Footer Left Most Popular 2
     */
    public function top2FootLeft(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
             'blog_user','blog_category','blog_image','created_at'
          ])->take(2)->get();
        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
        ]);  
    } 

    /**
     * Footer Right Most Popular 2
     */
    public function top2FootRight(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
             'blog_user','blog_category','blog_image','created_at'
          ])->take(2)->get();
        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
        ]);  
    } 

    /**
     * Footer Right Most Popular 2
     */
    public function homeRecentBlogs(){
        $limit = 8; $offset = 0;
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
             'blog_user','blog_category','blog_image','created_at'
        ])->orderBy('id', 'DESC')
          ->offset($offset)
          ->limit($limit)
          ->get();
        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
        ]);  
    }


     /**
     * Home Page Top Blog Big 1 Image
     */
    public function homeTopBlogsBig(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->with(['user:id,name as uname'])->orderBy('id', 'DESC') 
        ->limit(1)
        ->get(); 
        return ($getBlogs!=null)?$getBlogs->toArray():array();
    }

     /**
     * Home Page Top Blog Left 2
     */
    public function homeTopBlogsLeft(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->with(['user:id,name'])->orderBy('id', 'DESC') 
        ->limit(2)
        ->get();
        return ($getBlogs!=null)?$getBlogs->toArray():array(); 
    }
    
    /**
     * Home Page Top Blog Below Big Image 3 Images
     */
    public function homeTopBlogsBottom(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->with(['user:id,name'])->orderBy('id', 'DESC') 
        ->limit(3)
        ->get();
        return ($getBlogs!=null)?$getBlogs->toArray():array();
    }

    /**
     * Home Page Top Blog Below Big Image 3 Images
     */
    public function homeTopBlogs(){  
        return response()->json([
            'status'=>true,
            'data'=> [
                'topbig' => $this->homeTopBlogsBig(),
                'topleft' => $this->homeTopBlogsLeft(),
                'topbottom' => $this->homeTopBlogsBottom()
            ]
        ]); 
    }

     /**
     * Single blog detail
     */
    public function singleBlog($url){   
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->where(['blog_url'=>$url])->with(['category:id,category_name','user:id,name,image'])
        ->get(); 
        if($getBlogs!=null){
            $getBlogs = ($getBlogs!=null)?$getBlogs->toArray():array(); 
            return response()->json([
                'status'=>true,
                'exist'=>true,
                'data'=> [
                    'blogDetail' => $getBlogs
                ]
            ]); 
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Opps! Invalid Blog',
                'exist'=>false,
                'data'=> [
                    'blogDetail' => null
                ]
            ]); 
        } 
    }

     /**
     * Single Blog Page Similar Post
     */
    public function singleSimilarPost(){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->with(['user:id,name'])->orderBy('id', 'DESC') 
        ->limit(2)
        ->get();
        $getBlogs = ($getBlogs!=null)?$getBlogs->toArray():array(); 
        return response()->json([
            'status'=>true,
            'exist'=>true,
            'data'=> [
                'blogsList' => $getBlogs
            ]
        ]); 
    }

    /**
     * Blog Detail with categories
     */
     public function blogsByCategory($cname){ 
        $cat = Cat::where(['category_url'=>$cname])->first();
        if($cat!=null){ 
            $limit = 8; $offset = 0;
            $getBlogs = Blogs::select([
                'id','blog_name','blog_title','blog_url',
                'blog_user','blog_category','blog_image','created_at'
            ])->where(['blog_category'=>$cat->id])
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
            return response()->json([
                'status'=>true,
                'exist'=>true,
                'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
            ]);   
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'Opps! Invalid Category',
                'exist'=>true,
                'data'=> [
                    'data' => null
                ]
            ]); 
        }  
     }


    
}
