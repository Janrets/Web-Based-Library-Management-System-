<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Store;
use Validator;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers  = DB::table('vouchers')->orderBy('id', 'desc')->paginate(10);
        $stores = Store::all();
        return view('pages\admin\voucher\index',compact("vouchers","stores"));
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
        $voucher = new Voucher;
        $voucher->voucher_name = $request->input('voucher_name');
        $voucher->description = $request->input('description');
        $voucher->voucher_type = $request->input('voucher_type');
        $voucher->amount = $request->input('amount');
        $voucher->usage = $request->input('usage');
        $voucher->start_date = $request->input('start_date');
        $voucher->end_date = $request->input('end_date');
        $voucher->status = $request->input('status');
        $voucher->store_id = $request->input('store_id');
        $voucher->save();

        return redirect('/voucher')->with('success','Voucher Information Successfully Added!');
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
        $voucher = Voucher::findOrFail($id);
        $voucher->voucher_name = $request->input('voucher_name2');
        $voucher->description = $request->input('description2');
        $voucher->voucher_type = $request->input('voucher_type2');
        $voucher->amount = $request->input('amount2');
        $voucher->usage = $request->input('usage2');
        $voucher->start_date = $request->input('start_date2');
        $voucher->end_date = $request->input('end_date2');
        $voucher->status = $request->input('status2');
        $voucher->store_id = $request->input('store_id2');
        $voucher->save();
        return redirect('/voucher')->with('success','Voucher Information Successfully Updated!');
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

    public function search(Request $request)
    {
        if (isset($_GET['query'])) {
            $search_text = $_GET['query'];
            $vouchers = DB::table('vouchers')
            ->orderBy('id', 'desc')
            ->where('voucher_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();

            $stores = Store::all();

            return view('pages\admin\voucher\index',compact("vouchers","stores"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
