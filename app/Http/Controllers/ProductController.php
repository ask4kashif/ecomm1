<?php

namespace App\Http\Controllers;


use notify;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return view('admin.product.index',[
            'products'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $subcategories=Subcategory::all();
        return view('admin.product.create',[
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'additional_info'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasFile('image')) {

            $image= $request->file('image')->store('public/images');
        }

        Product::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-'),
            'description'=>$request->description,
            'additional_info'=>$request->additional_info,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'image'=>$image,
            'subcategory_id'=>$request->subcategory_id,
        ]);
        notify()->success('Product created successfully');
        return redirect()->route('product.index');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product=Product::where('slug',$slug)->first();
        $categories=Category::all();
        $subcategories=Subcategory::all();
        return view('admin.product.edit',[
            'product'=>$product,
            'categories'=>$categories,
            'subcategories'=>$subcategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $product=Product::where('slug',$slug)->first();
        $image=$product->image;

        if($request->hasFile('image')){
            $image=$request->file('image')->store('public/images');
            \Storage::delete($product->image);
        }
        $product->name=$request->name;
        $product->slug=Str::slug($request->name,'-');
        $product->description=$request->description;
        $product->additional_info=$request->additional_info;
        $product->price=$request->price;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->image=$image;

        $product->save();

        notify()->success('Product updated successfully');

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product=Product::where('slug',$slug)->first();
        $image=$product->image;
        if($product->delete())
        {
            \Storage::delete($image);
        }
        notify()->success('Product deleted successfully');

        return redirect()->route('product.index');
    }
}
