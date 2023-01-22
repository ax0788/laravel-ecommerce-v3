<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.account.profile.index', compact('user'));
    }



    public function edit($id)
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.account.profile.edit', compact('user'));
    }
}
