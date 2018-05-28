<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BuyerRequirement;
use App\Unit;
use App\Category;
use App\Country;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status_type = NULL )
    {
        $this->query = BuyerRequirement::with( 'status', 'unit' )->orderBy('id', 'DESC');

        if ( $status_type != NULL ) 
        {
            switch ($status_type) {
                case 'pending':
                    $status_id = 1;
                    break;

                case 'approved':
                    $status_id = 2;
                    break;
                
                case 'rejected':
                    $status_id = 3;
                    break;
            }
            $this->requirement = $this->query->where('status_id', $status_id )->get();
        }

        else{
            $this->requirement = $this->query->get();   
        }

        $this->data['requirements'] = $this->requirement;
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
        $this->data['country']        = Country::pluck( 'name', 'id' );
        
        return view( 'backend.requirement.show', $this->data );
    }


    public function status( Request $request, $id )
    {
        $this->validate( $request, [
            'name'              => 'required',
            'unit_id'           => 'required',
            'quantity'          => 'regex:/^[1-9]+[0-9]*$/',
            'description'       => 'required',
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'country_id'        => 'required',
            'state_id'          => 'required',
            'city_id'           => 'required',
            'img'               => 'mimes:jpg,jpeg,png|max:2000',
        ],
        [
            'name.required'             => 'Please enter requirement',
            'unit_id.required'          => 'Please select unit',
            'quantity.regex'            => 'Please enter quantity greate than 0',
            'description.required'      => 'Plese enter description',
            'category_id.required'      => 'Please select category',
            'sub_category_id.required'  => 'Please select sub category',
            'country_id.required'       => 'Please select country',
            'state_id.required'         => 'Please select state',
            'city_id.required'          => 'Please select city',
            'img'                       => 'mimes:jpg,jpeg,png|max:2000',
        ]
    );

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
            'slug'              => $this->slugify( $request->name ),
            'unit_id'           => $request->unit_id,
            'quantity'          => $request->quantity,
            'description'       => $request->description,
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'country_id'        => $request->country_id,
            'state_id'          => $request->state_id,
            'city_id'           => $request->city_id,
            'status_id'         => $status 
        ];

        BuyerRequirement::where( 'id', $id )->update( $requirement );
        
        return redirect( route( 'admin.requirements.index' ) )->with( 'success', 'Status successfully updated' );
    }
}
