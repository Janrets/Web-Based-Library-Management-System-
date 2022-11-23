<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Voucher;
use App\Models\Order;
use Validator;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
        // $orders  = DB::table('orders')->orderBy('id', 'desc')->paginate(10);
        $orders  = DB::table('orders')
        ->select('orders.*','customers.last_name as c_lname','stores.store_name as s_name','drivers.last_name as d_lname')
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('stores','stores.id','=','orders.store_id')
        ->leftJoin('drivers','drivers.id','=','orders.driver_id')
        ->orderBy('id', 'desc')
        ->paginate(10);
        // $stores = Store::all();
        // $categories = Category::all();
        return view('pages\admin\order\index',compact("orders"));
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
        $order = new Order;
        $order->total_amount = $request->input('total_amount');
        $order->total_amount_less_voucher = $request->input('total_amount_less_voucher');
        $order->shipping_charges = $request->input('shipping_charges');
        $order->admin_earning = $request->input('admin_earning');
        $order->vendor_earning = $request->input('vendor_earning');
        $order->driver_earning = $request->input('driver_earning');
        $order->status = $request->input('status');
        $order->payment_type = $request->input('payment_type');
        $order->store_id = $request->input('store_id');
        $order->customer_id = $request->input('customer_id');
        $order->driver_id = $request->input('driver_id');
        $order->save();
        $lastOrderId = $order->id;


        $cart_lists = DB::table("cart_lists")->where('customer_id', $request->input('customer_id'))->get();
        foreach ($cart_lists as $cart) {
            DB::table('order_data')->insert(
                [
                'store_id' => $cart->store_id,
                'product_id' => $cart->product_id,
                'order_id' => $lastOrderId,
                'quantity' => $cart->quantity
                ]);
        }

        return response()->json([
            'status'=>200,
            'message'=>'Order Added Successfully.'
        ]);



        // $cart_lists = DB::table('cart_lists')
        // ->where('customer_id',$customer_id)
        // ->get();












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
        //
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $orders = Order::findOrFail($id);
        if($orders)
        {
            $orders->status = $request->input('orderStatus');
            if($request->input('update_driver_id')){
                $orders->driver_id = $request->input('update_driver_id');
                if($request->input('orderStatus') == 6 ){

                    $driver = Driver::findOrFail($request->input('update_driver_id'));
                    if($driver){
                        $driver->wallet = $driver->wallet + $orders->driver_earning;
                        $driver->update();
                    }
                    $store = Store::findOrFail($orders->store_id);
                    if($store){
                        $store->wallet =$store->wallet + $orders->vendor_earning;
                        $store->update();
                    }
                }

            }
             $orders->update();



            // to be continued
            // if($request->input('orderStatus') == 6){
            //     $checkCart = cart_list::where('order_id', '=', $id)->firstOrFail();
            //     if($orders)
            //     {

            //     }
            // }

            return response()->json([
                'status'=>200,
                'message'=>'Order Status Updated Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Nothing Found.'
            ]);
        }
    }

    public function search(Request $request)
    {




        if (isset($_GET['query'])) {
            $search_text = $_GET['query'];
            $orders  = DB::table('orders')
            ->select('orders.*','customers.last_name as c_lname','stores.store_name as s_name','drivers.last_name as d_lname')
            ->join('customers','customers.id','=','orders.customer_id')
            ->join('stores','stores.id','=','orders.store_id')
            ->leftJoin('drivers','drivers.id','=','orders.driver_id')
            ->orderBy('id', 'desc')
            ->where('orders.status','LIKE','%'.$search_text.'%')
            ->paginate(10);

            return view('pages\admin\order\index',compact("orders"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }



}
