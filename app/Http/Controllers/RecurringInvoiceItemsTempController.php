<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecurringInvoice;
use App\Models\RecurringInvoiceItemsTemp;
use Validator;
use Illuminate\Support\Facades\DB;


class RecurringInvoiceItemsTempController extends Controller
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
        // $transactions  = DB::table('invoices')
        // ->select('*')
        // ->join('banks','banks.id','=','transactions.bank_id')
        // ->paginate(10);

        $invoices  = DB::table('recurring_invoices')->orderBy('id', 'desc')->paginate(10);

        // $bank_accounts = Bank::all();
        return view('pages\admin\recurring_invoice\index',compact("invoices"));
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
            'item_name'=> 'required',
            'quantity'=>'required',
            'price'=>'required',
            'total'=>'required',
            'user_id'=>'required',
            'tax'=>'required',
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
            $invoice_items_temp = new RecurringInvoiceItemsTemp;
                $invoice_items_temp->item_name = $request->input('item_name');
                $invoice_items_temp->quantity = $request->input('quantity');
                $invoice_items_temp->price = $request->input('price');
                $invoice_items_temp->total = $request->input('total');
                $invoice_items_temp->user_id = $request->input('user_id');
                $invoice_items_temp->tax = $request->input('tax');

                $invoice_items_temp->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Recurring Invoice Item Successfully Added.'
                ]);
        } }

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
        $invoice_items_temps = RecurringInvoiceItemsTemp::findorFail($id);
        // $item_list =  ItemList::where('item_list_id', $id)->firstOrFail();


        if($invoice_items_temps)
        {
            $invoice_items_temps->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Item Deleted Successfully.'
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

    public function getItemList($user_id)
    {
        // $data = cart_list::where('customer_id',$customer_id)->get();
        // Log::info(json_encode($data));
        $data = DB::table('recurring_invoice_items_temps')
        ->select('*')
        ->join('services','services.id','=','recurring_invoice_items_temps.item_name')
         ->where('recurring_invoice_items_temps.user_id',$user_id)
        ->get();
        return response()->json(['data' => $data]);

        // $data = cart_list::all();
        // return response()->json([
        //     'data'=>$data,
        // ]);
    }

    public function getItem($item_id)
    {
        // $data = cart_list::where('customer_id',$customer_id)->get();
        // Log::info(json_encode($data));
        $data = DB::table('services')
        ->select('*')
         ->where('id',$item_id)
        ->get();
        return response()->json(['data' => $data]);

        // $data = cart_list::all();
        // return response()->json([
        //     'data'=>$data,
        // ]);
    }

}
