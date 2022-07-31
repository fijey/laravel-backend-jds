<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Helper\Helper;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $request->validate([
            'nik' => 'required|max:16|min:16|unique:users',
            'roles' => 'required',
        ]);

        try {
            $password = Helper::generateRandomString(6);
    
            $user = new User;
            $user->nik = $request->nik;
            $user->roles = $request->roles;
            $user->password = bcrypt($password);
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "Berhasil Mendaftar",
                'result' => [
                    'nik' => $request->nik,
                    'roles' => $request->roles,
                    'password' => $password,
                ],

            ]);

        } catch (\Exception $e) {
            return response->json([
                'status_code' => 500,
                'status_message' => $e,               
            ]);
        }

        // $user->createToken('auth-user')->plainTextToken;

    }

    public function login(Request $request){
        $request->validate([
            'nik' => 'required|max:16|min:16',
            'password' => 'required',
        ]);
        
        if(!Auth::attempt(['nik' => $request->nik, 'password' => $request->password])){
            return response()->json([
                'status_code' => 401,
                'status_message' => 'invalid NIK/Password'
            ]);
        }

        $user = User::where('nik', $request->nik)->first();
        $user->acessToken = $user->createToken('user')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Berhasil Login',
            'result' => $user,
            'type_token' => 'Bearer'
        ]);
    }
}
