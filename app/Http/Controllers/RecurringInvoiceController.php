<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecurringInvoice;
use App\Models\Customer;
use App\Models\Service;
use App\Models\RecurringInvoiceItemsTemp;
use Validator;
use Illuminate\Support\Facades\DB;


class RecurringInvoiceController extends Controller
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


        $recurring_invoices  = DB::table('recurring_invoices')
        ->select('recurring_invoices.recurring_invoice_no as i_inv_no','recurring_invoices.recurring_invoice_date as i_inv_date',
        'customers.first_name as c_first_name','customers.last_name as c_last_name','recurring_invoices.payment_terms as i_pay_term')
        ->join('customers','customers.id','=','recurring_invoices.customer_name')
        ->orderBy('recurring_invoices.id', 'desc')
        ->paginate(10);


        $customers = Customer::all();
        $services = Service::all();
        return view('pages\admin\recurring_invoice\index',compact("recurring_invoices","customers","services"));
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
        $invoices = new RecurringInvoice;
        $invoices->customer_name = $request->input('customer');
        $invoices->currency = $request->input('currency');
        $invoices->address = $request->input('address');
        $invoices->invoice_prefix = $request->input('invoice_prefix');
        $invoices->recurring_invoice_no = $request->input('invoice_no');
        $invoices->invoice_date = $request->input('invoice_date');
        $invoices->payment_terms = $request->input('payment_terms');
        $invoices->sales_tax = $request->input('sales_tax');
        $invoices->grand_total = $request->input('g_total');
        $invoices->status = 0;
        $invoices->save();

        $lastinvoicesId = $invoices->id;


        $invoice_items_temps = DB::table("recurring_invoice_items_temps")
        ->where('user_id', 1)->get();
        // ->where('user_id', Session::get('user_id'))->get();
        foreach ($invoice_items_temps as $invoice_items_temp) {
            DB::table('recurring_invoice_items')->insert(
                [
                'item_name' => $invoice_items_temp->item_name,
                'quantity' => $invoice_items_temp->quantity,
                'price' => $invoice_items_temp->price,
                'total' => $invoice_items_temp->total,
                'tax' => $invoice_items_temp->tax,
                'invoice_id' => $lastinvoicesId
                ]);

        }

        // delete all where user lang dapat hindi truncate para ung ibang gagamit eh ndi rin mabura ung current item
        InvoiceItemsTemp::truncate();
        return redirect('/recurring-invoice')->with('success','Recurring Invoice Successfully Added!');  }

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
