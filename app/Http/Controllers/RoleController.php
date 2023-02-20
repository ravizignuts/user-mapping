<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * API for create role
     * @param Request $request
     * @return json
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name'        => 'string|required',
            'description' => 'string|required'
        ]);
        $role = Role::create($request->only('name', 'description'));
        return response()->json([
            'message' => 'Role created successfully',
            'role'    => $role
        ]);
    }
    /**
     * API for update role
     * @param Request $request,$id
     * @return json
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'string|required',
            'description' => 'string|required'
        ]);
        $role = Role::findOrFail($id);
        $role->update($request->only('name', 'description'));
        return response()->json([
            'message' => 'Role updated successfully',
            'role'    => $role
        ]);
    }
    /**
     * API for delete role
     * @param $id
     * @return json
     */
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully',
            'role'    => $role
        ]);
    }
    /**
     * API for list role
     * @return json
     */
    public function list()
    {
        $roles = Role::get();
        return response()->json([
            'message' => 'List all role',
            'role'    => $roles
        ]);
    }
    /**
     * API for view role
     * @param $id
     * @return json
     */
    public function view($id)
    {
        $role = Role::findOrFail($id);
        return response()->json([
            'message' => 'Role details',
            'role'    => $role
        ]);
    }
}
