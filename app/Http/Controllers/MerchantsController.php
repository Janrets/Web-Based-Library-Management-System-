<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Twilio\Rest\Client;

class MerchantsController extends Controller
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
        // $merchants = Merchant::paginate(10)->orderBy('id', 'desc');
        $merchants  = DB::table('merchants')->orderBy('id', 'desc')->paginate(10);
        return view('pages\admin\merchant\index',compact("merchants"));
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



        // $validator = Validator::make($request->all(), [
        //     'fname' => 'required|min:2|max:255'
        // ]);

        // if ($validator->fails()) {
        //     return redirect('/merchant')->withErrors($validator)->withInput();
        // } else {

            // $request->validate([
            //     'fname' => 'required|min:2|max:255'
            // ]);

            // request()->validate([
            //     'fname' => 'required|min:2|max:255'
            // ],
            // [
            //     'fname.required' => 'required',
            //     'fname.min' => 'must more than 2'

            // ]);


            $merchant = new Merchant;
            $merchant->first_name = $request->input('fname');
            $merchant->last_name = $request->input('lname');
            $merchant->gender = $request->input('gender');
            $merchant->birthdate = $request->input('birthdate');
            $merchant->email = $request->input('email');
            $merchant->mobile = $request->input('mobile');
            $merchant->approval = $request->input('approval');
            $merchant->status = $request->input('status');
            $merchant->address = $request->input('address2');
            $merchant->lat = $request->input('location_lat2');
            $merchant->lng = $request->input('location_lang2');
            $merchant->tin = $request->input('tin');
            if($request->hasfile('prof_image')){
                $file1 = $request->file('prof_image');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'merchant-prof_image'.time().'.'.$extension1;
                $file1->move('uploads/merchant/', $filename1);
                $merchant->profile_image = $filename1;
            }
            if($request->hasfile('gov_id')){
                $file2 = $request->file('gov_id');
                $extension2 = $file2->getClientOriginalExtension();
                $origname = $file2->getClientOriginalName();
                $user2 = auth()->user()->name.'-'.auth()->user()->id;
                $filename2 = $user2.'merchant-gov_id'.time().'.'.$extension2;
                $file2->move('uploads/merchant/', $filename2);
                $merchant->gov_id = $filename2;
            }
            if($request->hasfile('buss_reg_cert')){
                $file3 = $request->file('buss_reg_cert');
                $extension3 = $file3->getClientOriginalExtension();
                $origname = $file3->getClientOriginalName();
                $user3 = auth()->user()->name.'-'.auth()->user()->id;
                $filename3 = $user3.'merchant-buss_reg_cert'.time().'.'.$extension3;
                $file3->move('uploads/merchant/', $filename3);
                $merchant->buss_reg_cert = $filename3;
            }
            if($request->hasfile('bir_form')){
                $file4 = $request->file('bir_form');
                $extension4 = $file4->getClientOriginalExtension();
                $origname = $file4->getClientOriginalName();
                $user4 = auth()->user()->name.'-'.auth()->user()->id;
                $filename4 = $user4.'merchant-bir_form'.time().'.'.$extension4;
                $file4->move('uploads/merchant/', $filename4);
                $merchant->bir_form = $filename4;
            }
            $merchant->save();

            return redirect('/merchant')->with('success','Merchant Information Successfully Added!');

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
        $merchant = Merchant::findOrFail($id);
        $merchant->first_name = $request->input('fname2');
        $merchant->last_name = $request->input('lname2');
        $merchant->gender = $request->input('gender2');
        $merchant->birthdate = $request->input('birthdate2');
        $merchant->email = $request->input('email2');
        $merchant->mobile = $request->input('mobile2');
        $merchant->approval = $request->input('approval2');
        $merchant->status = $request->input('status2');
        $merchant->address = $request->input('address');
        if($request->input('location_lat')){
            $merchant->lat = $request->input('location_lat');
        }
        if($request->input('location_lang')){
            $merchant->lng = $request->input('location_lang');
        }
        $merchant->tin = $request->input('tin2');
            if($request->hasfile('prof_image2')){
                $file1 = $request->file('prof_image2');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'merchant-prof_image2'.time().'.'.$extension1;
                // .'.'.time().'.'.$extension1;
                $file1->move('uploads/merchant/', $filename1);
                $merchant->profile_image = $filename1;
            }
            if($request->hasfile('gov_id2')){
                $file2 = $request->file('gov_id2');
                $extension2 = $file2->getClientOriginalExtension();
                $origname = $file2->getClientOriginalName();
                $user2 = auth()->user()->name.'-'.auth()->user()->id;
                $filename2 = $user2.'merchant-gov_id2'.time().'.'.$extension2;
                //  time().'.'.$extension2;
                $file2->move('uploads/merchant/', $filename2);
                $merchant->gov_id = $filename2;
            }
            if($request->hasfile('buss_reg_cert2')){
                $file3 = $request->file('buss_reg_cert2');
                $extension3 = $file3->getClientOriginalExtension();
                $origname = $file3->getClientOriginalName();
                $user3 = auth()->user()->name.'-'.auth()->user()->id;
                $filename3 = $user3.'merchant-buss_reg_cert2'.time().'.'.$extension3;
                // time().'.'.$extension;
                $file3->move('uploads/merchant/', $filename3);
                $merchant->buss_reg_cert = $filename3;
            }
            if($request->hasfile('bir_form2')){
                $file4 = $request->file('bir_form2');
                $extension4 = $file4->getClientOriginalExtension();
                $origname = $file4->getClientOriginalName();
                $user4 = auth()->user()->name.'-'.auth()->user()->id;
                $filename4 = $user4.'merchant-bir_form2'.time().'.'.$extension4;
                // 'time().'.'.$extension;
                $file4->move('uploads/merchant/', $filename4);
                $merchant->bir_form = $filename4;
            }
        $merchant->save();
        return redirect('/merchant')->with('success','Merchant Information Successfully Updated!');
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
            // $merchants = Merchant::where('first_name','LIKE','%'.$search_text.'%')->paginate(2);
            $merchants = DB::table('merchants')
            ->orderBy('id', 'desc')
            ->where('first_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();
            return view('pages\admin\merchant\index',compact("merchants"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }

    public function getproducts(Request $request)
    {

        $test  = DB::table('product')
        ->select('product.product_name as p_name','product.id as p_id','product.amount as p_amount',
                 'merchants.id as m_id','merchants.first_name as m_fname')
        ->join('merchants','merchants.id','=','product.merchant_id')
        ->where('product.merchant_id', $request->input('id'))
        ->paginate(8);
        return response()->json($test, 200);
    }

    public function index2()
    {
        $merchants  = DB::table('merchants')->orderBy('id', 'asc')->paginate(10);
        return view('pages\admin\merchant\index',compact("merchants"));

    }


    public function getproducts2()
    {
        $merchants  = DB::table('merchants')
        ->select('*')
        ->join('product','product.id','=','merchants.id')
        // THE NUMBER 1 IS HARD CODED
        ->where('merchants.id', 1)
        ->paginate(8);
        return response()->json($merchants, 200);
    }

    public function getUsers($id = 0){
        if($id ==0){
            $merchants = Merchant::orderby('id',asc)
                        ->select('*')
                        ->get();
        }
        else{

        }
        $userData['data'] = $employees;

        echo json_encode($userData);
        exit;
    }

    public function sendsms()
    {
        $receiverNumber = "+639755145384";
        $message = "This is testing from ItSolutionStuff.com";

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            dd('SMS Sent Successfully2.');

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }


}
