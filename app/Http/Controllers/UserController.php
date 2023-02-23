<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * API for create User
     * @param Request $request
     * @return json data
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            // 'first_name' => 'string|required',
            // 'last_name'  => 'string|required',
            // 'password'   => 'string|min:8|max:20',
            // 'email'      => 'string|required|unique:users,email',
            // 'code'       => 'string|required|min:6|unique:users,code',
            // 'type'       => 'string|required|in:superadmin,admin,user',
            'user_id'      => 'required|uuid',
            'role_id.*'    => 'exists:roles,id'
        ]);
        // $request['password'] = Hash::make($request->password);
        // $user = User::create($request->only('first_name', 'last_name', 'email', 'password', 'code', 'type'));
        $user = User::findOrFail($request->user_id);
        $user->roles()->attach($request->role_id);
        return response()->json([
            'message' => 'User created successfully',
            'user'    => $user
        ]);
    }
    /**
     * API for update user
     * @param Request $request,$id
     * @return json data
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'code'       => 'string|required|min:6',
            'type'       => 'string|required|in:superadmin,admin,user',
            'role_id.*'  => 'exists:roles,id'
        ]);
        $user = User::findOrFail($id);
        $user->update($request->only('first_name', 'last_name', 'code', 'type'));
        $user->roles()->sync($request->role_id);
        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $user
        ]);
    }
    /**
     * API for delete user
     * @param Request $request,$id
     * @return json data
     */
    public function delete(Request $request,$id)
    {
        $user = User::withTrashed()->findOrFail($id);
        if($request->softdelete == 'softdelete') $user->delete();
        else $user->forcedelete();
        return response()->json([
            'message' => 'User deleted successfully',
            'user'    => $user
        ]);
    }
    /**
     * API for restore module
     * @param $id
     * @return json
     */
    public function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return response()->json([
            'message'    => 'User Restored successfully',
            'module'     =>  $user
        ]);
    }
    /**
     * API for view user
     * @param $id
     * @return json data
     */
    public function view($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return response()->json([
            'message' => 'User detail',
            'user'    => $user
        ]);
    }
    /**
     * API for list user
     * @param Request $request
     * @return json data
     */
    public function list(Request $request)
    {
        // $users = User::with('roles')->get();
        // $users = DB::table('users')->paginate($request->per_page,['*'],$request->page_number);
        $users = User::query();
        $perpage = $request->per_page;
        $page_number = $request->page_number;
        $users->orderBy('id','asc');
        $users = $users->skip($perpage * ($page_number - 1))->take($perpage);
        return response()->json([
            'message' => 'List of all users',
            'current_page' => $page_number,
            'user'    => $users->get()
        ]);
    }
}
