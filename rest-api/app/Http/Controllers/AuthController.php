<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function doRegister(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) || empty($password)) {
            return response()->json([
                "message" => "input tidak boleh kosong",
            ], 401);
        } 

        $validasi = [
            "name" => $name,
            "password" => Hash::make($password),
            "login_tokens" => Str::random(30)
        ];


        $create = User::create($validasi);

        if(!$create) {
            return response()->json([
                "message" => "gagal"
            ], 401);
        } else {
            return response()->json([
                "message" => "sukses",
            ]);
        }
    }

    public function doLogin(Request $request)
    {
        $name = $request->input("name");
        $password = $request->input("password");

        if(empty($name) || empty($password)) {
            return response()->json([
                "message" => "input tidak boleh kosong",
            ], 401);
        } 

        $validasi = User::where("name", $name)->first();

        $validasi->update([
            "login_tokens" => Str::random(30)
        ]);

        if(!$validasi || !Hash::check($password, $validasi->password)) {
            return response()->json([
                "message" => "gagal login"
            ], 401);
        } else {
            return response()->json([
                "message" => "login berhasil"
            ]);
        }
    }

}
