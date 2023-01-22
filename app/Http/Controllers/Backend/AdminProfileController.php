<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function UsersIndex()
    {
        $users = User::where('role', NULL)->latest()->get();
        return view('admin.users.index', compact('users'));
    }

}