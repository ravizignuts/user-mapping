<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function CreateRole(Request $request)
    {
        $res = Role::create([
        'name' => $request->name,
        'description' => $request->description,
        'is_active' => $request->is_active,
        ]);
        if($res){
            return ["Record"=>"Role Created Successfuly"];
        }
        else{
            return ["Record"=>"Role is Not Created"];
        }
    }
    public function UpdateRole(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->is_active = $request->is_active;
        $res = $role->save();
        if($res){
            return ["Record"=>"Role Updated Successfuly"];
        }
        else{
            return ["Record"=>"Role is Not Updated"];
        }
    }
    public function DeleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

    }
    public function ListRole()
    {
        $role = Role::all();
        return $role;
    }
}
