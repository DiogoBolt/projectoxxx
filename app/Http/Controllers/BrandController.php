<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Family;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class BrandController extends Controller
{

    protected $authUser;

    protected $request;


    public function index()
    {
        $brands = Brand::all();
        return view('brands.index',compact('brands'));

    }
    public function newBrand()
    {
        return view('brands.new');
    }
    public function createBrand(Request $request)
    {
        $inputs = $request->all();
        $brand = new Brand;
        $brand->name = $inputs['name'];
        $brand->save();
        return redirect('/brands');
    }
    public function editBrand($id)
    {
        $brand= Brand::where('id',$id)->first();
        return view('brands.edit',compact('brand'));
    }
    public function postEditBrand(Request $request,$id)
    {
        $inputs = $request->all();
        $brand = Brand::where('id',$id)->first();
        $brand->name = $inputs['name'];
        $brand->save();
        return redirect('/brands');
    }
    public function deleteBrand($id)
    {
        $brand = Brand::where('id',$id)->first();
        if(Product::where('brand_id',$id)->exists())
        {
            return redirect('/brands')
                ->withErrors('There are products associated with this category');
        }else{
            $brand->delete();
        }
        return redirect('/brands');
    }





}
