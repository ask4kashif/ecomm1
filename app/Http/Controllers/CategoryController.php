<?php

namespace App\Http\Controllers;

use Image;
use notify;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Storage;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories=Category::latest()->get();
        return view('admin.category.index',[
            'categories'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);

        if ($request->hasFile('image')) {

            $image= $request->file('image')->store('public/images');
        }

        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-'),
            'description'=>$request->description,
            'image'=>$image,
        ]);
        notify()->success('Category created successfully');
        return redirect()->route('category.index');

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
        $category=Category::where('slug',$slug)->first();
        return view('admin.category.update',[
            'category'=> $category,
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
        $category=Category::where('slug',$slug)->first();

        $image=$category->image;

        if($request->hasFile('image')){
            $image=$request->file('image')->store('public/images');
            Storage::delete($category->image);
        }
        $category->name=$request->name;
        $category->slug=Str::slug($request->name,'-');
        $category->description=$request->description;
        $category->image=$image;

        $category->save();

        notify()->success('Category updated successfully');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category=Category::where('slug',$slug)->first();


        if(Storage::exists($category->image)){
            Storage::delete($category->image);
          }
          $category->delete();

        notify()->success('Category deleted');
        return redirect()->back();
    }
}
