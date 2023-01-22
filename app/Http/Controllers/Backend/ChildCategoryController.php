<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as category;
use App\Models\SubCategory as subcategory;
use App\Models\ChildCategory as childcategory;

class ChildCategoryController extends Controller
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
          $childcategory = ChildCategory::latest()->get();
          return view('admin.childcategory.index', compact('categories', 'childcategory'));
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
                'subcategory_id' => 'required',
                'childcategory_name_en' => 'required',
            ],
            [
                'category_id.required' => 'Please Select a Category',
                'subcategory_name_en.required' => 'Please Input a valid Category name!',

            ]
        );

        ChildCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_name_en' => $request->childcategory_name_en,
            'childcategory_slug_en' => strtolower(str_replace(' ', '-', $request->childcategory_name_en)),
        ]);

        $notification = array(
            'message' => 'Childcategory Added Successfully!',
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
    public function edit(Childcategory $childcategory)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        return view('admin.childcategory.edit', compact('categories', 'subcategories', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $childcategory)
    {
        ChildCategory::findOrFail($childcategory)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_name_en' => $request->childcategory_name_en,
            'childcategory_slug_en' => strtolower(str_replace(' ', '-', $request->childcategory_name_en)),
        ]);

        $notification = array(
            'message' => 'Childcategory updated successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->route('admin.childcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        childcategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Childcategory Deleted Successfully!',
            'alert-type' => 'info'
        );

        return  redirect()->back()->with($notification);
    }

    public function GetSubCategory($category_id)
    {
        $subcategoryitem = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcategoryitem);
    }


    public function GetSubSubCategory($subcategory_id)
    {

        $subcategoryitem = ChildCategory::where('subcategory_id', $subcategory_id)->orderBy('childcategory_name_en', 'ASC')->get();
        return json_encode($subcategoryitem);
    }

}