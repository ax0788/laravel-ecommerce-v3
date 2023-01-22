<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as category;
use App\Models\SubCategory as subcategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             // Pass foriegn Key categories data
             $categories = Category::orderBy('category_name_en', 'ASC')->get();
             $subcategory = SubCategory::latest()->get();
             return view('admin.subcategory.index', compact('subcategory', 'categories'));
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
                'category_id' => 'required',
                'subcategory_name_en' => 'required',
            ],
            [
                'category_id.required' => 'Please Select a Category',
                'subcategory_name_en.required' => 'Please Input a valid Category name!',

            ]
        );

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
        ]);

        $notification = array(
            'message' => 'SubCategory Added Successfully!',
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
    public function edit(Subcategory $subcategory)

    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('admin.subcategory.edit', compact('categories', 'subcategory'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subcategory)
    {
        SubCategory::findOrFail($subcategory)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->route('admin.subcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        subcategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'SubCategory Deleted Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->back()->with($notification);    }



         // Route to get SubCategory data and pass it to the option field in sub_subcategory_view page.
    public function GetSubCategory($category_id)
    {
        $subcategoryitem = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategoryitem);
    }
}