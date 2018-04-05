<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubCategory as SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $subcategory = SubCategory::where('category_id', $category_id)->get();
        return view('backend.subcategory.index')->with('subcategories', $subcategory);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $category_id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories'
        ]);


        SubCategory::create([
            'name' => $request->input('name') ,
            'slug' => str_slug( $request->input('name') ) ,
            'category_id' => $category_id
        ]);
        return redirect(route('admin.subcategories.index', [$category_id]));
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
    public function edit($category_id, $id)
    {
        $sub_category = SubCategory::find($id);
        return view('backend.subcategory.edit')->with('sub_category', $sub_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id, $id)
    {
        SubCategory::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => str_slug( $request->input('name') ),
        ]);
        return redirect( route('admin.subcategories.index', [$category_id] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $id)
    {
        SubCategory::destroy($id);
        return redirect(route('admin.subcategories.index', [$category_id]));
    }
}
