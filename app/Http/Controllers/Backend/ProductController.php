<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\SubCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = public_path("upload/products/thumbnail/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save(public_path('upload/products/thumbnail/' . $name_gen));
        $image->move(public_path('upload/products/thumbnail', $name_gen));
        $save_url = 'upload/products/thumbnail/' . $name_gen ;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp_en,
            'long_descp' => $request->long_descp_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        // Multiple Image Upload START

        $direc = public_path("upload/products/multi-image/");

        if (!file_exists($direc)) {
            mkdir($direc, 0777);
        }

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $upload_path =  'upload/products/multi-image/' . $make_name ;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }
        // Multiple Image Upload END

        $notification = array(
            'message' => 'Product Added Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->route('admin.products.create')->with($notification);
    } //Store method END

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
    public function edit($id)
    {

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        // Get specific product data with its id. only 1 product.
        $products = Product::findOrFail($id);
        $multiImages = MultiImg::where('product_id', $id)->get();
        return view('admin.product.edit', compact('brands', 'categories', 'subcategories', 'products', 'multiImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $prod_id = $product->id;

        Product::findOrFail($prod_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),                'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags_en,
            'product_size' => $request->product_size_en,
            'product_color' => $request->product_color_en,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp_en,
            'long_descp' => $request->long_descp_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Updated Without Image Successfully!',
            'alert-type' => 'success'
        );

        return  redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  Product::findOrFail($id);
        $product_image = $product->product_thumbnail;
        if (file_exists($product_image)) {
            unlink($product_image);
        }
        Product::findOrFail($id)->delete();

        $multi_images = MultiImg::where('product_id', $id)->get();
        foreach ($multi_images as $image) {

            if (file_exists($image->photo_name)) {
                unlink($image->photo_name);
            }
            MultiImg::where('product_id', $id)->delete();
        } // End Foreach
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return  redirect()->back()->with($notification);
    }


    public function InactiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Product is now inactive & no longer purchasable',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    } //End Method

    public function ActiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Product is now active and can be purchased in the store!',
            'alert-type' => 'success'
        );
        return  redirect()->back()->with($notification);
    }


    public function UpdateThumbnail(Request $request)
    {

        $prod_id = $request->id;
        $existing_img = $request->old_img;
        if (file_exists($existing_img)) {
            unlink($existing_img);
        }
        $path = public_path("upload/products/thumbnail/");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($prod_id)->update([
            'product_thumbnail' =>  $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Thumbnail Image Updated Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }

    public function UpdateMultiImage(Request $request)
    {

        $images = $request->multi_img;

        foreach ($images as $id => $image) {
            $path = public_path("upload/products/multi-image/");
            $imgDel = MultiImg::findOrFail($id);
            if (file_exists($imgDel)) {

                unlink($path . $imgDel->photo_name);
            }

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);

            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' =>  $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        } //End For each
        $notification = array(
            'message' => 'Product Image Updated Successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->back()->with($notification);
    }

    public function DeleteMultiImage($id){

        $old_img = MultiImg::findOrFail($id);
        $existing_img = $old_img->photo_name;
        if (file_exists($existing_img)) {
            unlink($existing_img);
        }
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Image(s) Deleted Successfully!',
            'alert-type' => 'success'
        );
        return  redirect()->back()->with($notification);
    }
}