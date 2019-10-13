<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\BlogCategoryModel as Cat; 
use Validator;

class BlogCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
         $getCat = Cat::select('id','category_name','category_url','created_at','id as value','category_name as text')->get(); 
         return response()->json([
             'status'=>true,
             'data'=> ($getCat!=null)?$getCat->toArray():array()
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'category_name' => 'required',
            'category_url' => 'required' 
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
            $res = Cat::create($data);
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'New category added successfully',
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
        $getCat = Cat::find($id);  //->toArray(); 
        if($getCat!=NULL){ $getCat = $getCat->toArray(); }else{ $getCat = null; }
        return response()->json([
            'status'=>true,
            'data'=> $getCat
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=null)
    {
        $data = $request->all(); 
        if(!$data['id']){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this category id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        } 
        $getCat = Cat::find($data['id']);
        if($getCat == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this category id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }
        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
            'category_url' => 'required'
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
            $res = $getCat->update($data); //Events::create($data); 
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'Category updated successfully',
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
        $getCat = Cat::find($id);
        if($getCat == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this category id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }else{
            $getCat->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Category deleted successfully',
                'result'=>[
                    'errors'=> null,
                    'data'=> null
                ]
            ]); 
        }
    }
}
