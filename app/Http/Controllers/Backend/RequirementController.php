<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BuyerRequirement;
use App\Unit;
use App\category;
class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = BuyerRequirement::with('status', 'unit')->get();
        return view('backend.requirement.index', compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requirement = BuyerRequirement::find($id);
        $units = Unit::pluck('name', 'id');
        $category = Category::pluck('name', 'id');
        return view('backend.requirement.show', compact('requirement', 'units', 'category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function status(Request $request, $id)
    {
        $this->validate($request,
        [
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required',
            'unit_id' => 'required',
            'quantity' => 'required',
            'description' => 'required'
        ]);

        if ($request->status == 'Approve') 
        {
            $status = '2';
        }
        if ($request->status == 'Reject') 
        {
            $status = '3';
        }

        $options = [
            'name' => $request->name,
            'slug' => $this->slugify($request->name),
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'status_id' => $status 
        ];
        BuyerRequirement::where('id', $id)->update($options);
        return redirect(route('admin.requirements.index'))->with('success', 'Status successfully updated');
    }
}
