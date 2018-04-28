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
        $this->data['requirements'] = BuyerRequirement::with( 'status', 'unit' )->get();

        return view( 'backend.requirement.index', $this->data );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $this->data['requirement']    = BuyerRequirement::find( $id );
        $this->data['units']          = Unit::pluck( 'name', 'id' );
        $this->data['category']       = Category::pluck( 'name', 'id' );
        
        return view( 'backend.requirement.show', $this->data );
    }


    public function status( Request $request, $id )
    {
        $this->validate( $request, [
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'name'              => 'required',
            'unit_id'           => 'required',
            'quantity'          => 'required',
            'description'       => 'required'
        ]);

        if( $request->status == 'Approve' ) 
        {
            $status = '2';
        }
        if( $request->status == 'Reject' ) 
        {
            $status = '3';
        }

        $requirement = [
            'name'              => $request->name,
            'slug'              => $this->slugify($request->name),
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'status_id'         => $status 
        ];

        BuyerRequirement::where( 'id', $id )->update( $requirement );
        
        return redirect( route( 'admin.requirements.index' ) )->with( 'success', 'Status successfully updated' );
    }
}
