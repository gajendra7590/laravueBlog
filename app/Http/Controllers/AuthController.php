<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//Permissions
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


use Auth;
use App\User; 
use App\models\Blogs;
use Carbon\Carbon;
use Mail,URL;


class AuthController extends Controller
{ 
    use HasRoles;

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
        $baseURL = URL::to('/');
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
            $code = rand(10000,999999);
            $time = time();
            $data['password'] = Hash::make($data['password']);
            $data['verify_code'] = $code;
            $data['verify_code_time'] = $time;
            $res = User::create($data);
            if($res){                
                //Assign Write roles
                $res->assignRole('writer'); 
                $emailData = $res->toArray();
                $emailData['code'] = $code;
                $this->sendEmailfun($emailData);
                $identifier = $emailData['id'].'.'.rand(10000,999999).'.'.$time;
                $returnData = array(
                    'identifier'=> base64_encode($identifier),
                    'email' => $emailData['email']
                );
                return response()->json([
                    'status'=>true,
                    'message'=>'Your account created successfully.',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $returnData
                    ]
                ]); 
            } 
        } 
    } 

    public function verifyAccount(Request $request){
        $data = $request->all();
        $identifier = $data['identifier'];
        if($identifier!=''){
            $identifier = base64_decode($identifier); 
            $ex = explode('.',$identifier); 
            if( count($ex) == 3){
                 $id = $ex[0]; 
                 $findUser = User::find($id);
                 if($findUser!=null){
                    return response()->json([
                        'status'=>true,
                        'message'=>'Idenitifier is validated.',
                        'result'=>[
                            'errors'=> null,
                            'data'=> []
                        ]
                    ]); 
                 }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Invalid identifier token,no user exist',
                        'result'=>[
                            'data' => [],
                            'errors' => null
                        ]
                    ]);

                 }                 
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Invalid identifier token',
                    'result'=>[
                        'data' => [],
                        'errors' => null
                    ]
                ]); 
            }
        } 
    }

    public function verifySubmitAccount(Request $request){
        $data = $request->all(); 
        $validator = Validator::make($request->all(),[ 
            'code' => ['required'] 
        ]);   
        if($validator->fails()){
            $allMessages = $validator->messages();
            $errors = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $errors
                ]
            ]); 
        }     
        $identifier = $data['identifier'];
        $code = trim($data['code']);
        if($identifier!=''){
            $identifier = base64_decode($identifier); 
            $ex = explode('.',$identifier); 
            if( count($ex) == 3){
                 $id = $ex[0]; 
                 $findUser = User::find($id); 
                 if( ($findUser!=null) && isset($findUser->verify_code) && ($findUser->verify_code == $code) ){  
                    $findUser->update(['active'=>1,'verify_code'=>null,'verify_code_time'=>null]); 
                    return response()->json([
                        'status'=>true,
                        'message'=>'Your has been activated successfully',
                        'result'=>[
                            'data' => [],
                            'errors' => null
                        ]
                    ]);  
                 }else{
                    return response()->json([
                        'status'=>false,
                        'message'=>'Your verification code is invalid',
                        'result'=>[
                            'data' => [],
                            'errors' => array(
                                'code'=>'Your verification code is invalid'
                             )
                        ]
                    ]); 
                 }  
            }
        }else{ 
            return response()->json([
                'status'=>false,
                'message'=>'Invalid identifier',
                'result'=>[
                    'data' => [],
                    'errors' => null
                ]
            ]); 

        }
    }

    public function verifyResendCode(Request $request){
        $data = $request->all(); 
        $validator = Validator::make($request->all(),[ 
            'email' => ['required','email'] 
        ]);   
        if($validator->fails()){
            $allMessages = $validator->messages();
            $errors = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $errors
                ]
            ]); 
        }   
        
        $user = User::where( array('email'=>$data['email']))->first();
        if($user){
            $userData = $user->toArray(); 
            $updateData = array(); 
            $code = rand(10000,999999);
            $time = time(); 
            $updateData['verify_code'] = $code;
            $updateData['verify_code_time'] = $time;
            $user->update($updateData);  
            $userData['code'] = $code;
            $this->sendEmailfun($userData);
            
            $identifier = $userData['id'].'.'.rand(10000,999999).'.'.$time;
                $returnData = array(
                    'identifier'=> base64_encode($identifier),
                    'email' => $userData['email']
                );
                return response()->json([
                    'status'=>true,
                    'message'=>'code sended on you register email id please check.',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $returnData
                ]
            ]); 

        }else{ 
            return response()->json([
                'status'=>false,
                'message'=>'Invalid email address',
                'result'=>[
                    'data' => [],
                    'errors' => [
                        'email'=>'Email address is not exist'
                    ]
                ]
            ]); 

        } 
    }

    public function forgotPasswordCodeSend(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),[ 
            'email' => ['required','email'] 
        ]);   
        if($validator->fails()){
            $allMessages = $validator->messages();
            $errors = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $errors
                ]
            ]); 
        }   

        $user = User::where(['email'=>$data['email']])->first();
        if($user!=null){ 
            $userData = $user->toArray(); 
            $updateData = array(); 
            $code = rand(10000,999999);
            $time = time(); 
            $updateData['verify_code'] = $code;
            $updateData['verify_code_time'] = $time;
            $user->update($updateData);  
            $userData['code'] = $code;
            $this->sendEmailfun($userData,'reset_password');  
                $returnData = array( 
                    'email' => $userData['email']
                );
                return response()->json([
                    'status'=>true,
                    'message'=>'code sended on you register email id please check.',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $returnData
                ]
            ]);
        }else{ 
            return response()->json([
                'status'=>false,
                'message'=>'Email not exist',
                'result'=>[
                    'data' => [],
                    'errors' => ['email'=>'This email address is not exist']
                ]
            ]); 
        } 
    }

    public function forgotPasswordCodeVerify(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(),[ 
            'code' => ['required'],
            'password' => ['required'] 
        ]);   
        if($validator->fails()){
            $allMessages = $validator->messages();
            $errors = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please correct form values',
                'result'=>[
                    'data' => [],
                    'errors' => $errors
                ]
            ]); 
        }  
        
        $user = User::where(['email'=>$data['email'],'verify_code'=>$data['code']])->first(); 
        if($user!=null){  
            $updateData['verify_code'] = null;
            $updateData['verify_code_time'] = null; 
            $updateData['password'] = Hash::make($data['password']); 
            $user->update($updateData);  
                return response()->json([
                    'status'=>true,
                    'message'=>'Your password has been changed successfully',
                    'result'=>[
                        'errors'=> null,
                        'data'=> null
                   ]
            ]);
        }else{ 
            return response()->json([
                'status'=>false,
                'message'=>'Invalid one time password',
                'result'=>[
                    'data' => [],
                    'errors' => ['code'=>'Invalid one time password ']
                ]
            ]); 
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
                'allBlogs' => Blogs::all()->count()
            )
        ]); 
    } 

    public function sendEmailfun($data,$templatePage=''){  
        $template = 'email.verify_account';
        $subject = 'Account Verification - VueLara Team';
        switch($templatePage){
            case 'reset_password' :
               $template = 'email.reset_password_code';
               $subject = 'Password Change - VueLara Team'; 
            break;  
        } 
        Mail::send($template, ['email_data'=>$data], function ($message) use ($data,$subject){ 
            $message->subject($subject);
            $message->to($data['email']);
        });
    }
     
}
