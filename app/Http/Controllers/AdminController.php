<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use function auth;
use function request;
use function response;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $user = Admin::create([
            'name' => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'phone'=> $request->phone,
        ]);

        $token = auth('admin')->login($user);

        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('admin')->factory()->getTTL() * 60
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::all();
    }

}
