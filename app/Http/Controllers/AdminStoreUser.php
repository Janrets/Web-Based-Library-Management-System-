<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreUser;
use App\Models\Merchant;
use Validator;
use Illuminate\Support\Facades\DB;

class AdminStoreUser extends Controller
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
        $storeusers  = DB::table('store_users')->orderBy('id', 'desc')->paginate(10);
        $merchants = Merchant::all();
        return view('pages\merchant\store_user\index',compact("storeusers","merchants"));

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
        $storeuser = new StoreUser;
        $storeuser->first_name = $request->input('fname');
        $storeuser->last_name = $request->input('lname');
        $storeuser->gender = $request->input('gender');
        $storeuser->birthdate = $request->input('birthdate');
        $storeuser->email = $request->input('email');
        $storeuser->mobile = $request->input('mobile');
        $storeuser->approval = $request->input('approval');
        $storeuser->status = $request->input('status');
        $storeuser->address = $request->input('address2');
        $storeuser->lat = $request->input('location_lat2');
        $storeuser->lng = $request->input('location_lang2');
        $storeuser->merchant_id = $request->input('merchant_id');
        if($request->hasfile('prof_image')){
            $file1 = $request->file('prof_image');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'storeuser-prof_image'.time().'.'.$extension1;
            $file1->move('uploads/storeuser/', $filename1);
            $storeuser->profile_image = $filename1;
        }
        $storeuser->save();

        return redirect('/merchant-storeuser')->with('success','Store User Information Successfully Added!');

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
        $storeuser = StoreUser::findOrFail($id);
        $storeuser->first_name = $request->input('fname2');
        $storeuser->last_name = $request->input('lname2');
        $storeuser->gender = $request->input('gender2');
        $storeuser->birthdate = $request->input('birthdate2');
        $storeuser->email = $request->input('email2');
        $storeuser->mobile = $request->input('mobile2');
        $storeuser->approval = $request->input('approval2');
        $storeuser->status = $request->input('status2');
        $storeuser->address = $request->input('address');
        if($request->input('location_lat')){
            $storeuser->lat = $request->input('location_lat');
        }
        if($request->input('location_lang')){
            $storeuser->lng = $request->input('location_lang');
        }
        $storeuser->merchant_id = $request->input('merchant_id2');
            if($request->hasfile('prof_image2')){
                $file1 = $request->file('prof_image2');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'storeuser-prof_image2'.time().'.'.$extension1;
                // .'.'.time().'.'.$extension1;
                $file1->move('uploads/storeuser/', $filename1);
                $storeuser->profile_image = $filename1;
            }
        $storeuser->save();
        return redirect('/merchant-storeuser')->with('success','Store User Information Successfully Updated!');

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
            $storeusers = DB::table('store_users')
            ->orderBy('id', 'desc')
            ->where('first_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();

            $merchants = Merchant::all();
            return view('pages\merchant\store_user\index',compact("storeusers","merchants"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
