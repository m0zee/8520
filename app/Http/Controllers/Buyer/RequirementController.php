<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\BuyerRequirement;
use App\Unit;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = BuyerRequirement::with('status', 'unit')->where('user_id', Auth::user()->id)->get();
        return view('frontend.buyer.requirement.index', compact( 'requirements' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::pluck('name', 'id');
        return view('frontend.buyer.requirement.create', compact('units') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'unit_id' => 'required',
                'quantity' => 'required',
                'description' => 'required',
            ]
        );

        $lastRow = BuyerRequirement::orderBy( 'id', 'DESC' )->first();
        $code = ( $lastRow ) ? $this->generate_code( $lastRow->code ) : 'req-0001';

        // return $request->all();

        $options = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'slug' => $this->slugify($request->name),
            'code' => $code,
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status_id' => '1'
        ];
        BuyerRequirement::create($options);
        return redirect( route('buyer.requirements') )->with( 'success', 'Requirement successfully added' );
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
    public function edit($code)
    {
        $units = Unit::pluck('name', 'id');
        $requirement = BuyerRequirement::where('code', $code)->first();
        return view('frontend.buyer.requirement.edit', compact('units', 'requirement') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'unit_id' => 'required',
                'quantity' => 'required',
                'description' => 'required',
            ]
        );

        $options = [
            'name' => $request->name,
            'slug' => $this->slugify($request->name),
            'unit_id' => $request->unit_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'status_id' => '1'
        ];
        BuyerRequirement::where('code', $code)->update($options);
        return redirect( route('buyer.requirements') )->with( 'success', 'Requirement successfully updated' );
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



    public function generate_code( $code )
    {
        $code =  explode( '-', $code );

        $index  = $code[1] + 1;

        $length = strlen( $index );

        switch( $length )
        {
            case 1:
                $index = '000' . $index;
            break;
            
            case 2:
                $index = '00' . $index;
            break;

            case 3:
                $index = '0' . $index;
            break;
        }

        $code = 'req-'. $index;

        return $code;
    }
}
