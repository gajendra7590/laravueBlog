<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\ContactUsModel as Contact;
use Auth;
use Validator;

class ContactUs extends Controller
{
     public function contactDetailSave(Request $request){
        $data = $request->all();  
        $validator = Validator::make($request->all(),[
            'contact_subject' => 'required',
            'contact_fullname' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|numeric|min:10',
            'contact_message' => 'required',
            'contact_company' => 'required' 
        ]);  
        if($validator->fails()){
            $allMessages = $validator->messages();
            $result = errorArrayCreate($allMessages); 
            return response()->json([
                'status'=>false,
                'message'=>'Please fill mendatory fields.',
                'result'=>[
                    'data' => [],
                    'errors' => $result
                ]
            ]); 
        }else{  
            $res = Contact::create($data);
            if($res){
                return response()->json([
                    'status'=>true,
                    'message'=>'Your contact query posted successfully,Our team will contact you soon.',
                    'result'=>[
                        'errors'=> null,
                        'data'=> $res->toArray()
                    ]
                ]); 
            } 
        } 
     }
}
