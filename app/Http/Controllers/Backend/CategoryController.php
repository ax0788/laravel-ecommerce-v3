<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'category_icon' => 'required',
                'category_name_en' => 'required',
            ],
            [
                'category_icon.required' => 'Please input Font-awesome icon class',
                'category_name_en.required' => 'Please input valid category name',

            ]
        );

        Category::insert([
            'category_icon' =>  $request->category_icon,
            'category_name_en' => $request->category_name_en,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
        ]);

        $notification = array(
            'message' => 'Category Added Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        Category::findOrFail($category)->update([
            'category_id' => $request->category_id,
            'category_icon' => $request->category_icon,
            'category_name_en' => $request->category_name_en,
            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
        ]);
        $notification = array(
            'message' => 'Category Updated Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->back()->with($notification);    }
}