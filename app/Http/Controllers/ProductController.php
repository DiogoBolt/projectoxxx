<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\Category;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{

    protected $authUser;

    protected $request;


    public function index()
    {
        $products = Product::with('category','brand')->get();
        return view('products.index', compact('products'));

    }

    public function newProduct()
    {
        $brands = Brand::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        return view('products.new',compact('categories','brands'));
    }

    public function createProduct(Request $request)
    {
        $inputs = $request->all();
        $product = new Product;
        $product->name = $inputs['name'];
        $product->category_id = $inputs['category'];
        $product->brand_id = $inputs['brand'];
        $product->description = $inputs['description'];
        $product->price = $inputs['price'];

        if ($request->hasFile('img')) {
            $image = $request->file('img');

            $filename = str_random(16) . '.' . $image->getClientOriginalExtension();
            $image->move('img', $filename);
            $product->img = $filename;
        }


        $product->save();
        return redirect('/products');
    }

    public function editProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $brands = Brand::all()->pluck('name', 'id');
        $categories = Category::all()->pluck('name', 'id');
        return view('products.edit', compact('product', 'brands','categories'));
    }

    public function postEditProduct(Request $request, $id)
    {
        $inputs = $request->all();
        $product = Product::where('id', $id)->first();
        $product->name = $inputs['name'];
        $product->category_id = $inputs['category'];
        $product->brand_id = $inputs['brand'];
        $product->description = $inputs['description'];
        $product->price = $inputs['price'];

        if ($request->hasFile('img')) {
            $image = $request->file('img');

            $filename = str_random(16) . '.' . $image->getClientOriginalExtension();
            $image->move('img', $filename);
            $product->img = $filename;
        }


        $product->save();
        return redirect('/products');
    }

    public function deleteProduct($id)
    {
        //todo: Product can be removed anyway, and PROMOTION THAT is associated to this product too.
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect('/products');
    }


}
