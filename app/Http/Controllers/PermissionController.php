<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\PermissionModule;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * API for create permission
     * @param Request $request
     * @return json data
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'                    => 'string|required|max:51',
            'description'             => 'string|required|max:151',
            'modules'                 => 'array',
            'modules.*.module_id'     => 'exists:modules,id',
            'modules.*.add_access'    => 'required|boolean',
            'modules.*.edit_access'   => 'required|boolean',
            'modules.*.delete_access' => 'required|boolean',
            'modules.*.view_access'   => 'required|boolean'
        ]);
        $permission = Permission::create($request->only('name', 'description'));
        $permission->modules()->createMany($request->modules);
        $modules = $request->modules;
        return response()->json([
            'message'    => 'Permission created successfully',
            'permission' => $permission,
            'modules'    => $modules
        ]);
    }
    /**
     * API for update permission
     * @param Request $request,$id
     * @return json data
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'                    => 'string|required|max:51',
            'description'             => 'string|required|max:151',
            'modules.*'               => 'array',
            'modules.*.module_id'     => 'exists:modules,id',
            'modules.*.add_access'    => 'required|boolean',
            'modules.*.edit_access'   => 'required|boolean',
            'modules.*.delete_access' => 'required|boolean',
            'modules.*.view_access'   => 'required|boolean'
        ]);
        $permission = Permission::findOrFail($id);
        $permission->update($request->only('name', 'description'));
        foreach ($request->modules as $module) {
            PermissionModule::updateOrCreate(
                [
                    'permission_id' => $permission->id,
                    'module_id'     => $module['module_id'],
                ],
                [
                    'add_access'    => $module['add_access'],
                    'view_access'   => $module['view_access'],
                    'delete_access' => $module['delete_access'],
                    'edit_access'   => $module['edit_access']
                ]
            );
        }
        return response()->json([
            'message'    => 'Permission Updated successfully',
            'permission' => $permission,
            'modules'    => $request->modules
        ]);
    }
    /**
     * API for delete permission
     * @param Request $request,$id
     * @return json data
     */
    public function delete(Request $request, $id)
    {
        $permission = Permission::withTrashed()->findOrFail($id);
        // $permission = Permission::onlyTrashed()findOrFail($id);
        if ($request->softdelete == 'softdelete')  $permission->delete();
        else $permission->forceDelete();
        return response()->json([
            'message'    => 'Permission deleted successfully',
            'permission' => $permission
        ]);
    }
    /**
     * API for restore module
     * @param $id
     * @return json
     */
    public function restore($id){
        $permission = Permission::withTrashed()->findOrFail($id);
        $permission->restore();
        return response()->json([
            'message'    => 'Permission Restored successfully',
            'module'     => $permission
        ]);
    }
    /**
     * API for view permission
     * @param $id
     * @return json data
     */
    public function view($id)
    {
        $permissions = Permission::with('modules')->findOrFail($id);
        return response()->json([
            'message'    => 'Permission details',
            'permission' => $permissions,
        ]);
    }
    /**
     * API for list all permissions
     * @param Request $request
     * @return json data
     */
    public function list(Request $request)
    {
        // $permissions = Permission::with('modules')->get();
        // $roles = DB::table('permissions')->paginate($request->per_page,['*'],$request->page_number);
        $permissions = Permission::query();
        $perpage = $request->per_page;
        $page_number = $request->page_number;
        $permissions = $permissions->skip($perpage * ($page_number - 1))->take($perpage);
        return response()->json([
            'message'      => 'All Permissions',
            'current_page' => $page_number,
            'permission'   => $permissions->get()
        ]);
    }
}
