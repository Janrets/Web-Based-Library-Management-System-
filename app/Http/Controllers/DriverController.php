<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use Validator;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
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
        $drivers  = DB::table('drivers')->orderBy('id', 'desc')->paginate(10);
        return view('pages\admin\driver\index',compact("drivers"));
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
            $driver = new Driver;
            $driver->first_name = $request->input('fname');
            $driver->last_name = $request->input('lname');
            $driver->gender = $request->input('gender');
            $driver->birthdate = $request->input('birthdate');
            $driver->email = $request->input('email');
            $driver->mobile = $request->input('mobile');
            $driver->approval = $request->input('approval');
            $driver->status = $request->input('status');
            $driver->address = $request->input('address2');
            $driver->lat = $request->input('location_lat2');
            $driver->lng = $request->input('location_lang2');
            $driver->vehicle_type = $request->input('vehicle_type');
            $driver->zipcode = $request->input('zipcode');
            if($request->hasfile('prof_image')){
                $file1 = $request->file('prof_image');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'driver-prof_image'.time().'.'.$extension1;
                $file1->move('uploads/driver/', $filename1);
                $driver->profile_image = $filename1;
            }
            if($request->hasfile('driver_license')){
                $file1 = $request->file('driver_license');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'driver-driver_license'.time().'.'.$extension1;
                $file1->move('uploads/driver/', $filename1);
                $driver->driver_license = $filename1;
            }
            if($request->hasfile('nbi')){
                $file2 = $request->file('nbi');
                $extension2 = $file2->getClientOriginalExtension();
                $origname = $file2->getClientOriginalName();
                $user2 = auth()->user()->name.'-'.auth()->user()->id;
                $filename2 = $user2.'driver-nbi'.time().'.'.$extension2;
                $file2->move('uploads/driver/', $filename2);
                $driver->nbi = $filename2;
            }
            if($request->hasfile('dead_of_sale')){
                $file3 = $request->file('dead_of_sale');
                $extension3 = $file3->getClientOriginalExtension();
                $origname = $file3->getClientOriginalName();
                $user3 = auth()->user()->name.'-'.auth()->user()->id;
                $filename3 = $user3.'driver-dead_of_sale'.time().'.'.$extension3;
                $file3->move('uploads/driver/', $filename3);
                $driver->dead_of_sale = $filename3;
            }
            if($request->hasfile('health_cert')){
                $file4 = $request->file('health_cert');
                $extension4 = $file4->getClientOriginalExtension();
                $origname = $file4->getClientOriginalName();
                $user4 = auth()->user()->name.'-'.auth()->user()->id;
                $filename4 = $user4.'driver-health_cert'.time().'.'.$extension4;
                $file4->move('uploads/driver/', $filename4);
                $driver->health_cert = $filename4;
            }
            $driver->save();

            return redirect('/driver')->with('success','Driver Information Successfully Added!');
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
        $driver = Driver::findOrFail($id);
        $driver->first_name = $request->input('fname2');
        $driver->last_name = $request->input('lname2');
        $driver->gender = $request->input('gender2');
        $driver->birthdate = $request->input('birthdate2');
        $driver->email = $request->input('email2');
        $driver->mobile = $request->input('mobile2');
        $driver->approval = $request->input('approval2');
        $driver->status = $request->input('status2');
        $driver->address = $request->input('address');
        $driver->zipcode = $request->input('zipcode2');
        $driver->vehicle_type = $request->input('vehicle_type2');
        if($request->input('location_lat')){
            $driver->lat = $request->input('location_lat');
        }
        if($request->input('location_lang')){
            $driver->lng = $request->input('location_lang');
        }

            if($request->hasfile('prof_image2')){
                $file1 = $request->file('prof_image2');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'driver-prof_image2'.time().'.'.$extension1;
                // .'.'.time().'.'.$extension1;
                $file1->move('uploads/driver/', $filename1);
                $driver->profile_image = $filename1;
            }
            if($request->hasfile('gov_id2')){
                $file2 = $request->file('gov_id2');
                $extension2 = $file2->getClientOriginalExtension();
                $origname = $file2->getClientOriginalName();
                $user2 = auth()->user()->name.'-'.auth()->user()->id;
                $filename2 = $user2.'driver-gov_id2'.time().'.'.$extension2;
                //  time().'.'.$extension2;
                $file2->move('uploads/driver/', $filename2);
                $driver->gov_id = $filename2;
            }
            if($request->hasfile('buss_reg_cert2')){
                $file3 = $request->file('buss_reg_cert2');
                $extension3 = $file3->getClientOriginalExtension();
                $origname = $file3->getClientOriginalName();
                $user3 = auth()->user()->name.'-'.auth()->user()->id;
                $filename3 = $user3.'driver-buss_reg_cert2'.time().'.'.$extension3;
                // time().'.'.$extension;
                $file3->move('uploads/driver/', $filename3);
                $driver->buss_reg_cert = $filename3;
            }
            if($request->hasfile('bir_form2')){
                $file4 = $request->file('bir_form2');
                $extension4 = $file4->getClientOriginalExtension();
                $origname = $file4->getClientOriginalName();
                $user4 = auth()->user()->name.'-'.auth()->user()->id;
                $filename4 = $user4.'driver-driver-bir_form2'.time().'.'.$extension4;
                // 'time().'.'.$extension;
                $file4->move('uploads/driver/', $filename4);
                $driver->bir_form = $filename4;
            }
        $driver->save();
        return redirect('/driver')->with('success','Driver Information Successfully Updated!');
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
            // $drivers = driver::where('first_name','LIKE','%'.$search_text.'%')->paginate(2);
            $drivers = DB::table('drivers')
            ->orderBy('id', 'desc')
            ->where('first_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();
            return view('pages\admin\driver\index',compact("drivers"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }

    public function getDriverOrders($driver_id)
    {
        $data1 = DB::table('drivers')
        ->select('orders.id as o_id','orders.total_amount as o_total_amount','orders.status as o_status','customers.last_name as c_lname','customers.address as c_address','stores.store_name as s_name')
        ->join('orders','orders.driver_id','=','drivers.id')
        ->join('customers','customers.id','=','orders.customer_id')
        ->join('stores','stores.id','=','orders.store_id')
        ->orderBy('orders.id', 'desc')
        ->where('orders.status','!=',6)
        ->where('drivers.id',$driver_id)
        ->count();



        if($data1 == 0){
            $driver_zip = DB::table('drivers')
            ->where('drivers.id',$driver_id)
            ->first();

            $zipcode = $driver_zip->zipcode;

            $data = DB::table('drivers')
            ->select('orders.id as o_id','orders.total_amount as o_total_amount','orders.status as o_status','customers.last_name as c_lname','customers.address as c_address','stores.store_name as s_name')
            ->RightJoin('orders','orders.driver_id','=','drivers.id')
            ->join('customers','customers.id','=','orders.customer_id')
            ->join('stores','stores.id','=','orders.store_id')
            ->orderBy('orders.id', 'desc')
            ->where('orders.status','!=',6)
            ->where('stores.zipcode','=',$zipcode)
            ->paginate(100);

            return response()->json(['data' => $data,
                                     'data2' => $data,
                                 'pagination' => (string) $data->links()]);
        }else{
            $data = DB::table('drivers')
            ->select('orders.id as o_id','orders.total_amount as o_total_amount','orders.status as o_status','customers.last_name as c_lname','customers.address as c_address','stores.store_name as s_name')
            ->join('orders','orders.driver_id','=','drivers.id')
            ->join('customers','customers.id','=','orders.customer_id')
            ->join('stores','stores.id','=','orders.store_id')
            ->orderBy('orders.id', 'desc')
            ->where('orders.status','!=',6)
            ->where('drivers.id',$driver_id)
            ->paginate(100);

            return response()->json(['data' => $data,
                                   'data3' => $data,
                                 'pagination' => (string) $data->links()]);
        }



    }


}
