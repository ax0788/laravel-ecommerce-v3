<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();

        $featured = Product::where('featured', 1)->limit(6)->orderBy('id', 'DESC')->get();
        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', Null)->limit(3)->orderBy('id', 'DESC')->get();
        $special_offer = Product::where('special_offer', 1)->limit(3)->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact('categories', 'products', 'featured', 'hot_deals', 'special_offer'));
    }

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);


        $size = $product->product_size;
        $product_size = explode(',', $size);


        $multiImage = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id',  $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.product.product_details', compact(
            'product',
            'multiImage',
            'product_color',
            'product_size',
            'relatedProduct'

        ));
    }

    public function ProductTag($tag)
    {
        $products = Product::where('status', 1)->where('product_tags', $tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.tags.index', compact('products', 'categories'));
    }



    public function CategoryWiseProduct(Request $request, $cat_id, $slug)
    {

        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $brands = Brand::orderBy('brand_name_en', 'ASC')->get();

        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('frontend.error.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('selling_price', 'ASC')->paginate(12);
            } else if ($sort == 'priceDesc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('selling_price', 'DESC')->paginate(12);
            } else if ($sort == 'discAsc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('discount_price', 'ASC')->paginate(12);
            } else if ($sort == 'discDesc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('discount_price', 'DESC')->paginate(12);
            } else if ($sort == 'titleAsc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('product_name_en', 'ASC')->paginate(12);
            } else if ($sort == 'titleDesc') {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->orderBy('product_name_en', 'DESC')->paginate(12);
            } else if ($request->input('filtercategory')) {
                $checked = $_GET['filtercategory'];
                // 2nd method without showing the category id in url, FILTER with name only
                // $subcategory_filter = Subcategory::whereIn('name', $checked)->get();
                // $subcateid = [];
                // foreach($subcategory_filter as $scid_list){
                //     array_push($subcateid, $scid_list->id)
                // }
                // END filter with Name
                $products = Product::whereIn('category_id', $checked)->where('status', 1)->paginate(12);
            } else {
                $products = Product::where(['status' => 1, 'category_id' => $cat_id])->paginate(12);
            }
        }

        $category_id = $cat_id;
        $category_slug = $slug;
        $currenturl = url()->full();
        return view('frontend.product.category', compact('brands', 'products', 'categories', 'category_id', 'category_slug', 'currenturl'));
    }






    public function SubCatWiseProduct($subcat_id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();

        return view('frontend.product.subcategory_view', compact('products', 'categories'));
    }


    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
/*
        $multiImage = MultiImg::where('product_id', $id)->get(); */
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
/*             'multiImage' => $multiImage,
 */            'product' => $product,
            'color' => $product_color,
            'size' =>  $product_size,
        ));
    }

    public function SearchAutoComplete(Request $request)
    {
        $query = $request->get('term', '');
        $services = Product::where('product_name_en', 'LIKE', '%' . $query . '%')->where('status', 1)->get();

        $data = [];
        foreach ($services as $service) {
            $data[] = [
                'value' => $service->product_name_en,
                'id' => $service->id,
            ];
        }
        if (count($data)) {
            return $data;
        } else {
            return ['value' => 'No Result Found', 'id' => ''];
        }
    }

    public function SearchResult(Request $request)
    {

        $searchingdata = $request->input('search_product');
        $products = Product::where('product_name_en', 'LIKE', '%' . $searchingdata . '%')->where('status', 1)->first();

        if ($products) {
            if (isset($_POST['searchbtn'])) {

                // Brand filter page
                // Collection/cate
                // return redirect('collection/' . $products->subcategory->category->group->url . '/' . $products->subcategory->category->url . '/' . $products->subcategory->url);
            } else {
                // PRODUCT-details Page
                // return redirect('collection/' . $products->subcategory->category->group->url . '/' . $products->subcategory->category->url . '/' . $products->subcategory->url . '/' . $products->url);
            }
            // Custom Url: create new route and page for it
            // return redirect('search/' . $products->url);
        } else {
            return redirect('/')->with('status', 'Product Not Available.');
        }
    }
}