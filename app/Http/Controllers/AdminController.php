<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminController extends Controller
{

    public function adminInfo(Request $request) {
        $admin = $request->input('id');
        $info = Admin::where('id', $admin)->get();
        return response()->json(['info' => $info]);

    }

    public function login(Request $request)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        $result = Admin::where('admin_username', $username)->get();
        if ($result && password_verify($password, $result[0]->admin_password)) {
            return response()->json(['message' => 'Authenticated', 'admin' => $result], 200);
        } else {
            return response()->json(['message' => 'Not Authenticated'], 401);
        }
    }
}
