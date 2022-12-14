<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {


    }
    public function home()
    {
        return view('admin.home');
    }
    public function loadSubCategories(Request $request,$id)
    {
        $subcategories = Subcategory::where('category_id',$id)->pluck('name','id');
        return response()->json($subcategories);
    }
}
