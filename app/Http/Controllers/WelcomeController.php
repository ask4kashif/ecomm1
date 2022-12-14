<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $watchProducts=Product::inRandomOrder()->limit(4)->get();
        $watchProductsIds=[];


        foreach($watchProducts as $watchProduct)
        {
            array_push($watchProductsIds,$watchProduct->id);
        }
        $watchProductsIds;
        $watchProducts2=Product::whereNotIn('id',$watchProductsIds)->limit(4)->get();

        $categories=Category::all();
        $products=Product::latest()->limit(9)->get();
        return view('user.WelcomePage',[
            'products'=>$products,
            'categories'=>$categories,
            'watchProducts'=>$watchProducts,
            'watchProducts2'=>$watchProducts2,
        ]);
    }
}
