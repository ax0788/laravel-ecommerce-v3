<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('admin.collection.group.index');
    }
    public function create()
    {
        return view('admin.collection.group.create');
    }
}