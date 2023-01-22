<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand as brand;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('admin.brands.index', compact('brands'));
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
                'brand_name_en' => 'required',
                'brand_image' => 'required',
            ],
            [
                'brand_name_en.required' => 'Input Brand Name in English ',
            ]
        );
        $path = public_path("upload/brand/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }


        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(300, 300)->save($path . $name_gen);
        $save_url = 'upload/brand/' . $name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Added Successfully!',
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
    public function edit( brand $brand)
    {

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            if(file_exists($old_img)){
                $path = public_path('upload/brand/') ;
                unlink($path . $old_img);
            }else{

                $image = $request->file('brand_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                Image::make($image)->resize(300, 300)->save(public_path("upload/brand/" . $name_gen));
                $image->move(public_path('public/brand', $name_gen));
                $save_url =  $name_gen;

                Brand::findOrFail($brand->id)->update([
                    'brand_name_en' => $request->brand_name_en,
                    'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                    'brand_image' => $save_url,
                ]);

                $notification = array(
                    'message' => 'Brand Updated Successfully!',
                    'alert-type' => 'success'
                );

                return  redirect()->route('admin.brands.index')->with($notification);

            }


        } else {
            Brand::findOrFail($brand->id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully!',
                'alert-type' => 'success'
            );

            return  redirect()->route('admin.brands.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $brand = Brand::findOrFail($id);
        $path = public_path('upload/brand/') ;

        if(file_exists($brand->brand_image)){
            unlink($brand->brand_image);
        }

        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }


}