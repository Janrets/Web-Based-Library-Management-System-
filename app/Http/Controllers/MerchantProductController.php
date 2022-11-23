<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;

class MerchantProductController extends Controller
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
        // $products  = DB::table('products')->orderBy('id', 'desc')->paginate(10);


        $products  = DB::table('products')
        ->select('products.*','stores.store_name as s_name','categories.category_name as c_name')
        ->join('stores','stores.id','=','products.store_id')
        ->join('categories','categories.id','=','products.category_id')
        ->join('store_users','store_users.id','=','stores.store_users_id')
        ->where('store_users.merchant_id', auth()->user()->id)
        ->orderBy('id', 'desc')
        ->paginate(10);



        $stores = Store::all();
        $categories = Category::all();

        $categories = DB::table('categories')
       ->where('categories.category_type', 1)
        ->get();
        return view('pages\merchant\product\index',compact("products","stores","categories"));
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
        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->store_id = $request->input('store_id');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->amount = $request->input('amount');
        $product->status = $request->input('status');
        if($request->hasfile('prof_image')){
            $file1 = $request->file('prof_image');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'product-prof_image'.time().'.'.$extension1;
            $file1->move('uploads/product/', $filename1);
            $product->profile_image = $filename1;
        }
        $product->save();
        return redirect('/merchant-product')->with('success','Product Information Successfully Added!');
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
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name2');
        $product->store_id = $request->input('store_id2');
        $product->description = $request->input('description2');
        $product->category_id = $request->input('category_id2');
        $product->amount = $request->input('amount2');
        $product->status = $request->input('status2');
        if($request->hasfile('prof_image2')){
            $file1 = $request->file('prof_image2');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'product-prof_image'.time().'.'.$extension1;
            $file1->move('uploads/product/', $filename1);
            $product->profile_image = $filename1;
        }
        $product->save();
        return redirect('/merchant-product')->with('success','Product Information Successfully Updated!');
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
            $products = DB::table('products')
            ->orderBy('id', 'desc')
            ->where('product_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();

            $stores = Store::all();
            $categories = Category::all();
            return view('pages\merchant\product\index',compact("products","stores","categories"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
