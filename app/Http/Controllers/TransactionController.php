<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use App\Models\Transaction;
use Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\Signup;

class TransactionController extends Controller
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

        $transactions  = DB::table('transactions')
        ->select('transactions.id as id',
                'materials.title as title',
                'transactions.quantity as quantity',
                'transactions.status as status',
                'transactions.date_available as date_available')
        ->join('materials','materials.id','=','transactions.material_id')
        ->orderBy('transactions.id', 'asc')
        // ->where('transactions.id', auth()->user()->id)
        ->paginate(10);

        return view('pages\admin\transaction\index',compact("transactions"));
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
            $transaction = new Transaction;
            $transaction->book_id = $request->input('material_id');
            $transaction->quantity = $request->input('quantity');
            $transaction->user_id = auth()->user()->id;
            $transaction->status = 0;
            $transaction->save();

            return redirect('/user/transaction')->with('success','Material Successfully Requested!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions  = DB::table('transactions')
        ->select('transactions.id as id',
                'materials.title as title',
                'transactions.quantity as quantity',
                'transactions.status as status',
                'users.mobile as u_mobile',
                'transactions.date_available as date_available')
        ->join('materials','materials.id','=','transactions.material_id')
        ->join('users','users.id','=','transactions.user_id')
        ->orderBy('transactions.id', 'asc')
        ->where('transactions.status', $id)
        ->paginate(10);

        return view('pages\admin\transaction\index',compact("transactions"));
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
        $transactions = Transaction::findOrFail($id);
        if($request->input('status')== 1){
            $transactions->date_available = $request->input('date_available');
        }
        $transactions->status = $request->input('status');
        //  $transactions->save();

        $path = '/transaction/'.$request->input('statustext');

        if($request->input('status')== 1 || $request->input('status')== 2){
            // dd($request->input('mobile2'));
            $receiverNumber = $request->input('mobile2');
            if($request->input('status') == 1){
                $message = "Your book request is approved and ready on ".$request->input('date_available');
            }else{
                $message = "Your book request is declined";
            }

            $transactions = DB::table('transactions')
            ->select('*')
            ->join('users','users.id','=','transactions.user_id')
            ->where('transactions.id',$id)
            ->get()
            ->toArray();

            $email = $transactions[0]->email;

            Mail::to($email)->send(new Signup($transactions));

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
        }





        return redirect($path)->with('success','Pending Request Successfully '.$request->input('action').'!');




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
