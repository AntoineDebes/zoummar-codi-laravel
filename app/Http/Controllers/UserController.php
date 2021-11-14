<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
class UserController extends Controller
{
    public function register(Request $request)
    {
        // file_put_contents(__DIR__.'/test.json', json_encode($request->data));
        $user = User::create([
            'name' => $request->data["Name"],
            'email'    => $request->data["Email"],
            'password' => $request->data["Password"],
            'phone'=> $request->data["Phone"],
        ]);

        $token = auth('user')->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {

        file_put_contents(__DIR__.'/test.json', json_encode($request->all()));

        $credentials = [
            'email' => $request->data["Email"],
            'password' => $request->data["Password"]
        ];

        // file_put_contents(__DIR__.'/test.json', json_encode($credentials));

        if (! $token = auth('user')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithTokenAndInfo($token);
    }

    public function logout()
    {
        auth('user')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('user')->factory()->getTTL() * 60
        ]);
    }


    protected function respondWithTokenAndInfo($token)
    {

        return response()->json([
            'user'         => auth('user')->user(),
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('user')->factory()->getTTL() * 60
        ]);
    }
}
