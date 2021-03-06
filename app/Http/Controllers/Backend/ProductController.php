<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status_type = NULL )
    {

        $this->query = Product::with( 'sub_category', 'category', 'user.detail', 'currency', 'status' );
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
            $this->product = $this->query->where('status_id', $status_id )->get();
        }
        else{
            $this->product = $this->query->get();   
        }
        
        $this->data['products'] = $this->product;

        return view( 'backend.product.index', $this->data );       
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
    public function show($code)
    {
        $product = Product::where('code', $code)->with('category', 'sub_category', 'currency', 'unit', 'user.detail', 'country', 'gallery')->first();
        return view('backend.product.show', compact('product') );
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


    public function status(Request $request, $id, $status)
    {
        if ($status == 'reject') {
            $newStatus = '3';
        }
        if ($status == 'approve') {
            $newStatus = '2';
        }

        Product::where('id', $id)->update([
            'status_id' => $newStatus
        ]);

        return back()->with('success', 'Status successfully updated');
    }
}
