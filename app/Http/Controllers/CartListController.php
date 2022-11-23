<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart_list;
use Validator;
use Illuminate\Support\Facades\DB;

class CartListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'quantity'=> 'required',
            'customer_id'=>'required',
            'product'=>'required',
            'store'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $cart_list = new cart_list;
                $cart_list->quantity = $request->input('quantity');
                $cart_list->customer_id = $request->input('customer_id');
                $cart_list->product_id = $request->input('product');
                $cart_list->store_id = $request->input('store');
                $cart_list->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Added to Cart Successfully.'
                ]);
        }
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
        $cart_list = cart_list::findorFail($id);
        if($cart_list)
        {
            $cart_list->delete();
            return response()->json([
                'status'=>200,
                'message'=>'List Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No List Found.'
            ]);
        }
    }
}
