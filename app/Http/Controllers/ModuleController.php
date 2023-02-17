<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function CreateModule(Request $request){
        $module = new Module;
        $module->id = $request->id;
        $module->module_code = $request->module_code;
        $module->name = $request->name;
        $module->is_active = $request->is_active;
        $module->is_in_menu = $request->is_in_menu;
        $module->display_order = $request->display_order;
        $res = $module->save();
        if($res){
            return ["Record"=>"Module Insertd Successfuly"];
        }
        else{
            return ["Record"=>"Module is Not Inserted"];
        }

    }
    public function UpdateModule(Request $request){
        $module = Module::find($request->id);
        $module->id = $request->id;
        $module->module_code = $request->module_code;
        $module->name = $request->name;
        $module->is_active = $request->is_active;
        $module->is_in_menu = $request->is_in_menu;
        $module->display_order = $request->display_order;
        $res = $module->save();
        if($res){
            return ["Record"=>"Module Updated Successfuly"];
        }
        else{
            return ["Record"=>"Module is Not Updated"];
        }
    }
    public function DeleteModule($id){
        $module = Module::find($id);
        $res = $module->delete();
        if($res){
            return ["Record"=>"Module Deleted Successfuly"];
        }
        else{
            return ["Record"=>"Module is Not Deleted"];
        }
    }
    public function ViewModule(){
        $module = Module::all();
        return $module;
    }
}
