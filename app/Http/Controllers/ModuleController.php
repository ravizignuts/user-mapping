<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * API for create module
     * @param Request $request
     * @return json
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
     * @return json
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
     * @param $id
     * @return json
     */
    public function delete($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();
        return response()->json([
            'message' => 'Module deleted successfully',
            'module'  => $module
        ]);
    }
    /**
     * API for view module
     * @param $id
     * @return json
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
     * @return json
     */
    public function list()
    {
        $modules = Module::get();
        return response()->json([
            'message' => 'All modules',
            'module'  => $modules
        ]);
    }
}
