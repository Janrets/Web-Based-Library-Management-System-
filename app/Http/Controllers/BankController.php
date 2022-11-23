<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Transaction;
use Validator;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
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
        $banks  = DB::table('banks')->orderBy('id', 'desc')->paginate(10);
        return view('pages\admin\bank\index',compact("banks"));
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
            $bank = new Bank;
            $bank->bank_name = $request->input('bank_name');
            $bank->description = $request->input('description');
            $bank->balance = $request->input('balance');
            $bank->acc_no = $request->input('acc_no');
            $bank->contact_person = $request->input('contact_person');
            $bank->phone = $request->input('phone');
            $bank->url = $request->input('url');
            $bank->save();
            $lastBankId = $bank->id;

            $transaction = new Transaction;
            $transaction->type = 1;
            $transaction->bank_id = $lastBankId;
            $transaction->from_bank_id = 1;
            $transaction->to_bank_id = 1;
            $transaction->date = now();
            $transaction->description = "Initial Balance";
            $transaction->amount = $request->input('balance');
            $transaction->balance = $request->input('balance');
            $transaction->save();

            return redirect('/bank')->with('success','Bank Information Successfully Added!');
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
        $bank = Bank::findOrFail($id);
        $bank->bank_name = $request->input('bank_name2');
        $bank->description = $request->input('description2');
        $bank->balance = $request->input('balance2');
        $bank->acc_no = $request->input('acc_no2');
        $bank->contact_person = $request->input('contact_person2');
        $bank->phone = $request->input('phone2');
        $bank->url = $request->input('url2');
        $bank->save();
        return redirect('/bank')->with('success','Bank Information Successfully Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return redirect('/bank')->with('success','Successfully Deleted!');

    }
    public function search(Request $request)
    {
        if (isset($_GET['query'])) {
            $search_text = $_GET['query'];
            $banks = DB::table('banks')
            ->orderBy('id', 'desc')
            ->where('bank_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();
            return view('pages\admin\bank\index',compact("banks"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
