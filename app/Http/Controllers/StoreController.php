<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreUser;
use App\Models\Store;
use Validator;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
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
        // $stores  = DB::table('stores')->orderBy('id', 'desc')->paginate(10);

        $stores  = DB::table('stores')
        ->select('stores.*','store_users.last_name as s_lname')
        ->join('store_users','store_users.id','=','stores.store_users_id')
        ->orderBy('id', 'desc')
        ->paginate(10);


        $storeusers = StoreUser::all();

        return view('pages\admin\store\index',compact("stores","storeusers"));



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
        $store = new Store;
        $store->store_name = $request->input('storename');
        $store->address = $request->input('address2');
        $store->lat = $request->input('location_lat2');
        $store->lng = $request->input('location_lang2');
        $store->open_time = $request->input('open_time');
        $store->close_time = $request->input('close_time');
        $store->store_users_id = $request->input('storeuser_id');
        $store->zipcode = $request->input('zipcode');
        $store->approval = $request->input('approval');
        $store->status = $request->input('status');
        if($request->hasfile('prof_image')){
            $file1 = $request->file('prof_image');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'store-prof_image'.time().'.'.$extension1;
            $file1->move('uploads/store/', $filename1);
            $store->profile_image = $filename1;
        }
        $store->save();
        return redirect('/store')->with('success','Store Information Successfully Added!');
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
        $store = Store::findOrFail($id);
        $store->store_name = $request->input('storename2');
        $store->address = $request->input('address');
        $store->open_time = $request->input('open_time2');
        $store->close_time = $request->input('close_time2');
        $store->store_users_id = $request->input('storeuser_id2');
        $store->zipcode = $request->input('zipcode2');
        $store->approval = $request->input('approval2');
        $store->status = $request->input('status2');
        if($request->input('location_lat')){
            $store->lat = $request->input('location_lat');
        }
        if($request->input('location_lang')){
            $store->lng = $request->input('location_lang');
        }
        if($request->hasfile('prof_image2')){
            $file1 = $request->file('prof_image2');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'store-prof_image'.time().'.'.$extension1;
            // .'.'.time().'.'.$extension1;
            $file1->move('uploads/store/', $filename1);
            $store->profile_image = $filename1;
        }
        $store->save();
        return redirect('/store')->with('success','Store Information Successfully Updated!');
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
            $stores = DB::table('stores')
            ->orderBy('id', 'desc')
            ->where('store_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();

            $storeusers = StoreUser::all();
            return view('pages\admin\store\index',compact("stores","storeusers"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }

    public function getCustomerStores($customer_id)
    {
        $cart_lists = DB::table('cart_lists')
        ->where('customer_id',$customer_id)
        ->first();

        if($cart_lists !=null){
            $data = DB::table('stores')
            ->where('id',$cart_lists->store_id)
            ->get();
        }
        else{
            $data = DB::table('stores')
            ->get();
        }

        // $data = DB::table('stores')
        // ->get();

        return response()->json(['data' => $data]);




    }
    public function getStores($customer_id)
    {
        $data = DB::table('cart_lists')
        ->select('stores.lat as s_lat','stores.lng as s_lng',)
        ->join('stores','stores.id','=','cart_lists.store_id')
        ->where('cart_lists.customer_id',$customer_id)
        ->get();

        return response()->json(['data' => $data]);

    }

    public function getOrders($store_id)
    {
        $data = DB::table('stores')
        ->select('stores.id as s_id','customers.last_name as c_lname','orders.id as o_id','orders.total_amount as o_tot_amt','orders.status as o_status','drivers.last_name as d_lname')
        ->join('orders','orders.store_id','=','stores.id')
        ->join('customers','customers.id','=','orders.customer_id')
        ->leftJoin('drivers','drivers.id','=','orders.driver_id')
        ->orderBy('orders.id', 'desc')
        ->where('stores.id',$store_id)
        ->paginate(100);



        return response()->json(['data' => $data,
                                 'pagination' => (string) $data->links()]);

    }

}
