<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //
    public function logout(Request $request) {
        $request->user()->update(['token' => null]);
        return response()->json(["message" => "logout success"]);
    }

    public function login(Request $request) {

        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('name', $data['username'])->first();
        if ($user && Hash::check($data['password'], $user['password'])) {
            $token = sha1(Str::random(12));
            $user->update([
                'token' => $token,
            ]);
            return response()->json($token, 200);
        }
        return response()->json(['message' => 'invalid login'], 401);

    }
    public function register(Request $request) {
        User::create(
            [
                'name' => $request['login'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'],
                'email'=> $request['email']
            ]);
        return 'success';
    }
}
