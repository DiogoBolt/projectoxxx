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
class FamilyController extends Controller
{

    protected $authUser;

    protected $request;


    public function index(Request $request)
    {
        $families = Family::all();
        return view('families.index',compact('families'));

    }
    public function newFamily()
    {
        return view('families.new');
    }
    public function createFamily(Request $request)
    {
        $inputs = $request->all();
        $family = new Family;
        $family->name = $inputs['name'];
        $family->save();
        return redirect('/families');
    }
    public function editFamily($id)
    {
        $family = Family::where('id',$id)->first();
        return view('families.edit',compact('family'));
    }
    public function postEditFamily(Request $request,$id)
    {
        $inputs = $request->all();
        $family = Family::where('id',$id)->first();
        $family->name = $inputs['name'];
        $family->save();
        return redirect('/families');
    }
    public function deleteFamily($id)
    {
        $family = Family::where('id',$id)->first();
        if(Category::where('family_id',$id)->exists())
        {
            return redirect('/families')
                ->withErrors('There are categories associated with this family');
        }else{
            $family->delete();
        }
        return redirect('/families');
    }





}
