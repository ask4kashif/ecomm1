<?php

namespace App\Http\Controllers;

use notify;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=Subcategory::all();
        return view('admin.subcategory.index',[
            'subcategories'=>$subcategories,
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
        return view('admin.subcategory.create',[
            'categories'=>$categories,
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
        // return $request->all();
        $request->validate([
            'name' => 'required|unique:subcategories|max:255',
            'category_id' => 'required',
        ]);


        Subcategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name,'-'),
            'category_id'=>$request->category_id,
        ]);
        notify()->success('Subcategory created successfully');
        return redirect()->route('subcategory.index');
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
        $categories=Category::all();
        $subcategory=Subcategory::where('slug',$slug)->first();

        return view('admin.subcategory.update',[
            'categories'=>$categories,
            'subcategory'=> $subcategory,
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
        $data=Subcategory::where('slug',$slug)->first();
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required',
        ]);

        $data->name=$request->name;
        $data->slug=Str::slug($request->name ,'-');
        $data->category_id=$request->category_id;

        $data->UPDATE();
        notify()->success('Subcategory updated successfully');
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $subCategory=subCategory::where('slug',$slug)->first();
          $subCategory->delete();
        notify()->success('Sub Category deleted');
        return redirect()->back();
    }
}
