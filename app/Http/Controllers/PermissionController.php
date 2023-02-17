<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function CreatePermission(Request $request){
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->is_active = $request->is_active;
        $permission->save();
        $module = Module::find($request->module_id);




    }
    public function UpdatePermission(){

    }
    public function DeletePermission($id){
        $permission = Permission::find($id);
        $res = $permission->delete();

    }
    public function ViewPermission(){
        $permission = Permission::all();
        return $permission;

    }
}
