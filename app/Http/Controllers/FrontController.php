<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// All Models
use App\models\Blogs;
use App\models\BlogCategoryModel as Cat;
use App\models\Company;
use App\User;

use Auth;
use Validator;

class FrontController extends Controller
{

    /**
     * Get Categories List for Front Menus
     */
    public function contactDetail(){  
        $getContactDetail = Company::where(['default'=>1])->get()->first(); 
         return response()->json([
             'status'=>true,
             'data'=> ($getContactDetail!=null)?$getContactDetail->toArray():array()
         ]);
    } 

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
    public function homeRecentBlogs(Request $request){
        $data = $request->all(); 
        $page = intval($data['pageNo']); 
        $page = ($page>=0)?($page-1):0;
        $limit = 8; $offset = ($page*$limit);
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
             'blog_user','blog_category','blog_image','created_at'
        ]); 
        $cnt = $getBlogs; 
        $count =  $cnt->count(); 
        $totalPage = 0;
        if($count > 0){
            $totalPage = ceil($count/$limit);
        } 

        $getBlogs = $getBlogs->orderBy('id', 'DESC')
        ->offset($offset)
        ->limit($limit)
        ->get();

        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array(),
            'totalPage'=>$totalPage
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
            'id','blog_name','blog_title','blog_url','blog_desc',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->where(['blog_url'=>$url])->with(['category:id,category_name,category_url','user:id,name,image'])
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
    public function singleSimilarPost($catname = ''){ 
        $getBlogs = Blogs::select([
            'id','blog_name','blog_title','blog_url',
            'blog_user','blog_category','blog_image','created_at','updated_at'
        ])->with(['user:id,name'])->orderBy('id', 'DESC') 
        ->limit(4)
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
     public function blogsByCategory(Request $request,$cname){ 
        $cat = Cat::where(['category_url'=>$cname])->first();
        if($cat!=null){   
            $data = $request->all();  
            $page = intval($data['filterData']['pageNo']); 
            $page = ($page>=0)?($page-1):0;
            $limit = 8; $offset = ($page*$limit);
            $getBlogs = Blogs::select([
                'id','blog_name','blog_title','blog_url',
                'blog_user','blog_category','blog_image','created_at'
            ])->where(['blog_category'=>$cat->id]);

            $cnt = $getBlogs; 
            $count =  $cnt->count(); 
            $totalPage = 0;
            if($count > 0){
                $totalPage = ceil($count/$limit);
            }  
            
            $getBlogs = $getBlogs->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
            return response()->json([
                'status'=>true,
                'exist'=>true,
                'totalPage'=>$totalPage,
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

     public function blogsByFilter(Request $request){  
            $data = $request->all();  
            $searchTxt = isset($data['text'])?$data['text']:''; 
            $page = intval($data['filterData']['pageNo']); 
            $page = ($page>=0)?($page-1):0;
            $limit = 8; $offset = ($page*$limit); 
            $getBlogs = Blogs::select([
                'id','blog_name','blog_title','blog_url',
                'blog_user','blog_category','blog_image','created_at'
            ]);
            if($searchTxt!=''){
                $getBlogs = $getBlogs
                ->orWhere('blog_name', 'like', '%' . $searchTxt . '%')
                ->orWhere('blog_title', 'like', '%' . $searchTxt . '%')
                ->orWhere('blog_desc', 'like', '%' . $searchTxt . '%')
                ->orWhere('blog_url', 'like', '%' . $searchTxt . '%');  
            } 
            $cnt = $getBlogs; 
            $count =  $cnt->count(); 
            $totalPage = 0;
            if($count > 0){
                $totalPage = ceil($count/$limit);
            }              
            $getBlogs = $getBlogs->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
            return response()->json([
                'status'=>true,
                'exist'=>true,
                'totalPage'=>$totalPage,
                'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
            ]);   
     }


    
}
