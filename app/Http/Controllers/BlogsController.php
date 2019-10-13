<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response; 
use App\models\Blogs;
use Auth;
use Validator;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $getBlogs = Blogs::select('id','blog_name','blog_title','blog_url','blog_user','blog_category','blog_image','created_at')
                           ->with('category:id,category_name','user:id,name,image')->get();
        return response()->json([
            'status'=>true,
            'data'=>($getBlogs!=null)?$getBlogs->toArray():array()
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // echo 'create page';die;
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $data = $request->all();  
        $validator = Validator::make($request->all(),[
            'blog_name' => 'required',
            'blog_title' => 'required',
            'blog_category' => 'required',
            'blog_url' => 'required',
            'blog_desc' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg',
        ]);  
        if($validator->fails()){
            $allMessages = $validator->messages();
            $result = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $result
                ]
            ]); 
        }else{ 
            $imageName = time().'.'.request()->file->getClientOriginalExtension(); 
            request()->file->move(public_path('images'), $imageName);
            $data['blog_image'] = $imageName;
            $data['blog_user'] = auth()->user()->id;
            $res = Blogs::create($data);
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'New blog created successfully',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $res->toArray()
                    ]
                ]); 
            } 
        } 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getBlogs = Blogs::find($id);  //->toArray(); 
        if($getBlogs!=NULL){ $getBlogs = $getBlogs->toArray(); }else{ $getBlogs = null; }
        return response()->json([
            'status'=>true,
            'data'=> $getBlogs
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all(); 
        if(!$data['id']){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this blog id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        } 
        $getBlogs = Blogs::find($data['id']);
        if($getBlogs == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this blog id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }
        $validator = Validator::make($request->all(),[
            'blog_name' => 'required',
            'blog_title' => 'required',
            'blog_category' => 'required',
            'blog_url' => 'required',
            'blog_desc' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg',
        ]);  
        if($validator->fails()){
            $allMessages = $validator->messages();
            $result = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $result
                ]
            ]); 
        }else{    
            if ($request->hasFile('file')) { 
                $imageName = time().'.'.request()->file->getClientOriginalExtension(); 
                request()->file->move(public_path('images'), $imageName);
                $data['blog_image'] = $imageName; 
            }  
            $res = $getBlogs->update($data); //Events::create($data); 
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'Blog updated successfully',
                    'result'=>[
                        'errors'=> null,
                        'data'=> null
                    ]
                ]); 
            } 
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getBlogs = Blogs::find($id);
        if($getBlogs == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this blog id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }else{
            $getBlogs->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Blog deleted successfully',
                'result'=>[
                    'errors'=> null,
                    'data'=> null
                ]
            ]); 
        }
    }
}
