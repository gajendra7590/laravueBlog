<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id; 
        $getUsers = User::where('id','!=',$id)->get()->toArray(); 
        return response()->json([
            'status' => true,
            'data' => $getUsers
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'file' => 'image|mimes:jpeg,png,jpg'
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
            if(!isset($data['password'])){ $data['password'] = '12345'; }; 
            $data['password'] = Hash::make($data['password']);
            if ($request->hasFile('file')) { 
                $imageName = time().'.'.request()->file->getClientOriginalExtension(); 
                request()->file->move(public_path('images'), $imageName);
                $data['image'] = $imageName; 
            }            
            $res = User::create($data);
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'New user created successfully',
                    'result'=>[
                        'errors'=> null,
                        'data'=> []
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
        $getUser = User::find($id);  //->toArray(); 
        if($getUser!=NULL){ 
                  $getUser = $getUser->toArray();
        }else{ 
            $getUser = null; 
        }
        return response()->json([
            'status'=>true,
            'data'=> $getUser
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=NULL)
    {
        $data = $request->all(); 
        if(!$data['id']){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this user id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        } 
        $getUser = User::find($data['id']);
        if($getUser == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this user id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$data['id'],
            'file' => 'image|mimes:jpeg,png,jpg'
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
                $data['image'] = $imageName; 
            }  
            $res = $getUser->update($data); //Events::create($data); 
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'User updated successfully',
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
        $getUser = User::find($id);
        if($getUser == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this user id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }else{
            $getUser->delete();
            return response()->json([
                'status'=>true,
                'message'=>'User deleted successfully',
                'result'=>[
                    'errors'=> null,
                    'data'=> null
                ]
            ]); 
        }
    }

    /**
     * Change status of specific user
     */
    public function changeStatus(Request $request){
        $inputData = $request->all();  
        $getUser = User::find($inputData['id']);
        if($getUser == NULL){
            return response()->json([
                'status'=>false,
                'message'=>'Opps! this user id is not exist',
                'result'=>[
                    'data' => null,
                    'errors' => null
                ]
            ]); 
        }else{
            $data = array('active'=> intval($inputData['status']) ); 
            $res = $getUser->update($data); 
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'User status updated successfully',
                    'result'=>[
                        'errors'=> null,
                        'data'=> null
                    ]
                ]); 
            }
            
        }

    }

   /**
    * Get Logged User Profile data
    */
    public function profile(Request $request){ 
        if(Auth::user()){
            $id = auth()->user()->id;
            $user = User::find($id);
            if($user!=NULL){                
                return response()->json([
                    'status'=>true,
                    'message'=>'User profile data',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $user
                    ]
                ]); 
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'User is no longer avaliable',
                    'result'=>[
                        'data' => [],
                        'errors' => null
                    ]
                ]); 
            } 
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'User is no longer avaliable',
                'result'=>[
                    'data' => [],
                    'errors' => null
                ]
            ]); 
        } 
    }
    
    /**
     * Update logged user profile data
     */
    public function profileUpdate(Request $request, $id=null){ 
        if(Auth::user()){
            $id = auth()->user()->id; 
            $data = $request->all();  
            $validator = Validator::make($request->all(),[
                'name' => 'required', 
                'file' => 'image|mimes:jpeg,png,jpg',
                'email' => 'email|unique:users,email,'.$id
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
                    $data['image'] = $imageName; 
                }   
                $user = User::find($id);
                $res = $user->update($data);
                if($res){
                    return response()->json([
                        'status'=>true,
                        'message'=>'Profile data updated successfully',
                        'result'=>[
                            'errors'=> null,
                            'data'=> []
                        ]
                    ]); 
                } 
            }  
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'User is no longer avaliable',
                'result'=>[
                    'data' => [],
                    'errors' => null
                ]
            ]); 
        }
       

    }
}
