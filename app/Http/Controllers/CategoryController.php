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
class CategoryController extends Controller
{

    protected $authUser;

    protected $request;


    public function index()
    {
        $categories = Category::with('family')->get();
        return view('categories.index',compact('categories'));

    }
    public function newCategory()
    {
        $families = Family::all()->pluck('name','id');

        return view('categories.new',compact('families'));
    }
    public function createCategory(Request $request)
    {
        $inputs = $request->all();
        $category = new Category;
        $category->name = $inputs['name'];
        $category->family_id = $inputs['family'];
        $category->save();
        return redirect('/categories');
    }
    public function editCategory($id)
    {
        $category= Category::where('id',$id)->first();
        $families = Family::all()->pluck('name','id');
        return view('categories.edit',compact('category','families'));
    }
    public function postEditCategory(Request $request,$id)
    {
        $inputs = $request->all();
        $category = Category::where('id',$id)->first();
        $category->name = $inputs['name'];
        $category->family_id = $inputs['family'];
        $category->save();
        return redirect('/categories');
    }
    public function deleteCategory($id)
    {
        $category = Category::where('id',$id)->first();
        if(Product::where('category_id',$id)->exists())
        {
            return redirect('/categories')
                ->withErrors('There are products associated with this category');
        }else{
            $category->delete();
        }
        return redirect('/categories');
    }





}
