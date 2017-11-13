<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;
class ProductController extends Controller
{

    protected $authUser;

    protected $request;


    public function index()
    {
        $product = Product::all();
        return view('products.index',compact('products'));

    }
    public function newProduct()
    {
        return view('products.new');
    }
    public function createProduct(Request $request)
    {
        $inputs = $request->all();
        $product = new Product;
        $product->name = $inputs['name'];
        $product->save();
        return redirect('/products');
    }
    public function editProduct($id)
    {
        $product = Product::where('id',$id)->first();
        return view('products.edit',compact('products'));
    }
    public function postEditProduct(Request $request,$id)
    {
        $inputs = $request->all();
        $product = Product::where('id',$id)->first();
        $product->name = $inputs['name'];
        $product->save();
        return rediproductrect('/products');
    }
    public function deleteProduct($id)
    {
        //todo: Product can be removed anyway, and PROMOTION THAT is associated to this product too.
        $product = Product::where('id',$id)->first();
        return redirect('/products');
    }





}
