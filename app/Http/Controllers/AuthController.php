<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User; 
use App\models\Blogs;
use Carbon\Carbon;


class AuthController extends Controller
{ 
    public function login(Request $request)
    { 
        $credentials = $request->only('email', 'password');  
        $validator = Validator::make($request->all(),[ 
            'email' => ['required','email'],
            'password' => ['required'],
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
        }    
        if (Auth::attempt($credentials)) {  
            $user = $request->user();
            if($user->active == '0'){
                return response()->json([
                    'status'=>false,
                    'message'=>'Your account is not active,please activate via activation link
                                OR contact to admin `vuelarademo@admin.com`',
                    'result'=>[
                        'data' => [],
                        'errors' => null
                    ]
                ]);  
            } 
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save(); 
            return response()->json([
                'status'=>true,
                'message'=>'You have logged in successfully',
                'result'=>[
                    'token'=>[
                        'access_token' => $tokenResult->accessToken,
                        'token_type' => 'Bearer',
                        'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                        )->toDateTimeString()
                        ],
                    'data' => [],
                    'errors' => null
                ]
            ]); 
        }else{ 
            return response()->json([
                'status'=>false,
                'message'=>'Invalid credentials as you provided',
                'result'=>[
                    'data' => [],
                    'errors' => null
                ]
            ]);  
        } 
    }

     
    public function register(Request $request)
    {
        $data = $request->all(); 
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required'],
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
            $data['password'] = Hash::make($data['password']);
            $res = User::create($data);
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'Your account created successfully.',
                    'result'=>[
                        'errors'=> null,
                        'data'=> []
                    ]
                ]); 
            } 
        } 
    } 

    public function logout(Request $request){
        $get = auth()->user()->tokens->each(function($token,$key){
            $token->delete();
        }); 

        return response()->json([
               'status' => true,
               'message'=>'You have logged out successfully' 
        ]);
    }

    public function dashboard(Request $request){ 
        return response()->json([
            'status' => true,
            'message'=>'Dashboard widgets data',
            'response'=>array(
                'allUsers' => User::all()->count(),
                'activeUsers' => User::where(['active'=>1])->count(),
                'inactiveUsers' => User::where(['active'=>0])->count(),
                'allEvents' => Blogs::all()->count()
            )
        ]); 
    }
     
}
