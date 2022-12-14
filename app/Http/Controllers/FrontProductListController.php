<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function show($slug)
    {
        $product=Product::where('slug',$slug)->first();
        $productFromSameCategories=Product::inRandomOrder()
        ->where('category_id',$product->category_id)
        ->where('id','!=',$product->id)->limit(4)->get();
        return view('user.showProduct',[
            'product'=>$product,
            'productFromSameCategories'=>$productFromSameCategories,
        ]);
    }
    public function productList(Request $request,$slug)
    {
        $category=Category::where('slug',$slug)->first();
        $filterSubcategoryId=$request->subcategory;

        if($request->subcategory ){
            // return $request->all();
            // $subcategoryId=[];
            // return $subcategory=Subcategory::whereIn('id',$request->subcategory)->get();
            // foreach($subcategory as $subcat)
            // {
            //     array_push($subcategoryId,$subcat->id);
            // }
            $products=Product::whereIn('subcategory_id',$request->subcategory)->get();
            if($request->min or $request->max){
                $products=Product::whereBetween('price',[$request->min,$request->max])
                ->where('category_id',$category->id)->get();
            }
        }
        elseif($request->min or $request->max){
            $products=Product::whereBetween('price',[$request->min,$request->max])
            ->where('category_id',$category->id)->get();
        }
        else
        {
            $products=$category->product;
            // $products=Product::where('category_id',$category->id)->get();
        }
        $subcategories=$category->subcategory;

        return view('user.listProduct',[
            'products'=>$products,
            'subcategories'=>$subcategories,
            'category'=>$category,
            'filterSubcategoryId'=>$filterSubcategoryId,
        ]);
    }
}
