<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\PermissionModule;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * API for create module
     * @param Request $request
     * @return json data
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'module_code'   => 'string|required',
            'name'          => 'string|required',
            'display_order' => 'string|required'
        ]);
        $module = Module::create($request->only('module_code', 'name', 'display_order'));
        return response()->json([
            'message' => 'Module created successfully',
            'module'  => $module
        ]);
    }
    /**
     * API for update module
     * @param Request $request,$id
     * @return json data
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'module_code'   => 'string|required',
            'name'          => 'string|required',
            'display_order' => 'string|required'
        ]);
        $module = Module::findOrFail($id);
        $module->update($request->only('module_code', 'name', 'display_order'));
        return response()->json([
            'message' => 'Module updated successfully',
            'module'  => $module
        ]);
    }
    /**
     * API for delete module
     * @param Request $request,$id
     * @return json data
     */
    public function delete(Request $request, $id)
    {

        $module = Module::withTrashed()->findOrFail($id);
        // $module = Module::onlyTrashed()->findOrFail($id);//it is return only trashed data
        $request->softdelete?$module->delete():$module->forceDelete();
        // $module->restore();
        return response()->json([
            'message'    => 'Module deleted successfully',
            'module'     => $module
        ]);
    }
    /**
     * API for view module
     * @param $id
     * @return json data
     */
    public function view($id)
    {
        $module = Module::findOrFail($id);
        return response()->json([
            'message' => 'Module  details',
            'module'  => $module
        ]);
    }
    /**
     * API for list module
     * @return json data
     */
    public function list()
    {
        $modules = Module::withTrashed()->get();
        return response()->json([
            'message' => 'All modules',
            'module'  => $modules
        ]);
    }
}
