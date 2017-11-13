<?php

namespace App\Http\Controllers;
use App\Brand;
use App\Category;
use App\Family;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class DashboardController extends Controller
{

    protected $authUser;

    protected $request;


    public function index(Request $request)
    {

        return view('dashboard.index');

    }

    public function categories()
    {
        $categories = Category::with('family');
        return view('categories.index',compact('categories'));
    }

    public function brands()
    {
        $brands = Brand::all();
        return view('brands.index',compact('brands'));
    }






}
