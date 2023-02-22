<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * API for register user
     * @param  Request $request
     * @return json data
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'email'      => 'string|required|unique:users,email',
            'password'   => 'string|min:8|max:20',
            'c_password' => 'string|same:password',
            'code'       => 'string|required|min:6',
            'type'       => 'string|required|in:superadmin,admin,user'
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->only('first_name', 'last_name', 'email', 'password', 'code', 'type'));
        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name']  = $user->first_name;
        $response = [
            'success' => true,
            'data'    => $success,
            'message' => 'User Registration Successfully'
        ];
        return response()->json($response, 200);
    }
    /**
     * API for Login user
     * @param  Request $request
     * @var \App\Models\User $user
     * @return json data
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'      => 'string|required|email',
            'password'   => 'string|min:8|max:20'
        ]);
        if($validator->fails()){
            $response=[
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response,400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name']  = $user->first_name;
            $response = [
                'success' => true,
                'data'    => $success,
                'message' => 'User Login Successfully'
            ];
            return response()->json($response, 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Credentials are Invalid'
            ]);
        }
    }
}
