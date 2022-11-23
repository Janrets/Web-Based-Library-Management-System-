<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\Withdrawal;
use Validator;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class MerchantWithdrawalController extends Controller
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
        $withdrawals  = DB::table('withdrawals')
        ->select('*')

        ->orderBy('id', 'desc')
        ->paginate(10);
        // $stores = Store::all();
        // $categories = Category::all();
        return view('pages\merchant\withdrawal\index',compact("withdrawals"));
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
        $withdrawal = new Withdrawal;
        $withdrawal->amount = $request->input('sum');
        $withdrawal->status = 0;
        $withdrawal->store_id = $request->input('store_id');

        $withdrawal->save();



            $receiverNumber ='+639755145384';
            $message = "Store Hazel Berry sent a withdrawal request with the total amount of: ".$withdrawal->amount."";

            try {

                $account_sid = getenv("TWILIO_SID");
                $auth_token = getenv("TWILIO_TOKEN");
                $twilio_number = getenv("TWILIO_FROM");

                $client = new Client($account_sid, $auth_token);
                $client->messages->create($receiverNumber, [
                    'from' => $twilio_number,
                    'body' => $message]);

                // dd('SMS Sent Successfully.');

            } catch (Exception $e) {
                // dd("Error: ". $e->getMessage());
            }



        return redirect('/merchant-store')->with('success','Store Request Withdrawal Successfully !');



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

            return view('pages\merchant\withdrawal\index',compact("orders"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }



}
