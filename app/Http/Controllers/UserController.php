<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * API for create User
     * @param Request $request
     * @return json
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'password'   => 'string|min:8|max:20',
            'email'      => 'string|required|unique:users,email',
            'code'       => 'string|required|min:6',
            'type'       => 'string|required|in:superadmin,admin,user',
        ]);
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->only('first_name', 'last_name', 'email', 'password', 'code', 'type'));
        return response()->json([
            'message' => 'User created successfully',
            'user'    => $user
        ]);
    }

    /**
     * API for update user
     * @param Request $request,$id
     * @return json
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'code'       => 'string|required|min:6',
            'type'       => 'string|required|in:superadmin,admin,user',
        ]);
        $user = User::findOrFail($id);
        $user->update($request->only('first_name', 'last_name', 'code', 'type'));
        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $user
        ]);
    }
    /**
     * API for delete user
     * @param $id
     * @return json
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
    /**
     * API for view user
     * @param $id
     * @return json
     */
    public function view($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'message' => 'User detail',
            'user'    => $user
        ]);
    }

    /**
     * API for list user
     * @return json
     */
    public function list()
    {
        $users = User::get();
        return response()->json([
            'message' => 'List of all users',
            'user'    => $users
        ]);
    }
}
