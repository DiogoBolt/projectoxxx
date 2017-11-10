<?php

namespace App\Http\Controllers;
use App\Brand;
use App\Category;
use App\Family;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use View, Datatable;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class DashboardController extends Controller
{

    protected $authUser;

    protected $request;

    /**
     * Constructor
     *
     */
    public function __construct(Request $request)
    {
        //$this->middleware('auth');
        $this->request = $request;
        $this->authUser = Auth::user();

        View::share('authUser', $this->authUser, 'request', $request);
    }

    /**
     * Display dashboard index page
     *
     * @return \View
     */
    public function index(Request $request)
    {

        return view('dashboard.index');

    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }
    public function families()
    {
        $families = Family::all();
        return view('families.index',compact('families'));
    }
    public function brands()
    {
        $brands = Brand::all();
        return view('brands.index',compact('brands'));
    }




}
