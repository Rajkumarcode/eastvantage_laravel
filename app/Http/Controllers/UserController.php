<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{

        public function store(Request $request){
            
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user_role,user_mail',
                'role' => 'required|string|',
            ];
            
            $input = $request->all('name','email','role');
            
            $validator = Validator::make($input, $rules);
            if($validator->fails()) {
                $error = $validator->messages();
                return response()->json(['success'=> false, 'error'=> $error]);
            }else{
                $user = UserRole::create([
                    'fullname' => $request->get('name'),
                    'user_mail' => $request->get('email'),
                    'user_role' => $request->get('role'),
                ]);
            }
            //echo'<pre>'; print_r($user); die();
            // $token = JWTAuth::fromUser($user);

            return response()->json(['Success'=>'Success','user'=>$user]);
        }

        public function users(){
            $user = UserRole::all();
            if(count($user) == 0){
                $user = []; 
            }

            return response()->json(['Success'=>'Success','user'=>$user]);
        }

     


}
