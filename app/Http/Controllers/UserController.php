<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    public function CreateUser(Request $request){
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->is_active=$request->is_active;
        $user->is_first_login=$request->is_first_login;
        $user->code=$request->code;
        $user->type=$request->type;
        $res = $user->save();
        if($res){
            return ["Result"=>"User is Saved"];
        }else{
            return ["Result"=>"User is not Saved"];
        }

    }
    public function UpdateUser(Request $request,$id){
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->is_active=$request->is_active;
        $user->is_first_login=$request->is_first_login;
        $user->code=$request->code;
        $user->type=$request->type;
        $res = $user->save();
        if($res){
            return ["Record"=>"Module Updated Successfuly"];
        }
        else{
            return ["Record"=>"Module is Not Updated"];
        }
    }
    public function DeleteUser($id){
        $user = User::find($id);
        $user->delete();
    }
    public function ListUser(){
        $user = User::all();
        return $user;

    }
}
