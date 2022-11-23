<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Validator;
use Illuminate\Support\Facades\DB;

class UserMaterialController extends Controller
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

        $materials  = DB::table('materials')
        ->select('materials.id as id',
                'materials.type as type',
                'materials.title as title',
                'materials.author as author',
                'materials.description as description',
                'categories.name as name')
        ->join('categories','categories.id','=','materials.category_id')
        ->orderBy('materials.id', 'asc')
        ->paginate(10);

        return view('pages\user\material\index',compact("materials"));
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
            $book = new Book;
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->description = $request->input('description');
            $book->category_id = $request->input('category_id'); 
            $book->type = $request->input('type'); 
            $book->save();
            

            return redirect('/book')->with('success','New Book Successfully Added!');
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
        $customer = Customer::findOrFail($id);
        $customer->first_name = $request->input('first_name2');
        $customer->last_name = $request->input('last_name2');
        $customer->email = $request->input('email2');
        $customer->phone = $request->input('phone2');
        $customer->address = $request->input('address2');
        $customer->city = $request->input('city2');
        $customer->state = $request->input('state2');
        $customer->zip = $request->input('zip2');
        $customer->country = $request->input('country2');
        $customer->currency = $request->input('currency2');
        $customer->save();
        return redirect('/customer')->with('success','Customer Information Successfully Updated!');

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
