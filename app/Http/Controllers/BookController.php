<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
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
        $books  = DB::table('books')->orderBy('id', 'desc')->paginate(10);

        $books  = DB::table('books')
        ->select('books.id as id',
                'books.type as type',
                'books.title as title',
                'books.author as author',
                'books.description as description',
                'categories.name as name')
        ->join('categories','categories.id','=','books.category_id')
        ->orderBy('books.id', 'asc')
        ->paginate(10);

        $categories = Category::all();
        return view('pages\admin\book\index',compact("books","categories"));
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
            $material = new Material;
            $material->title = $request->input('title');
            $material->author = $request->input('author');
            $material->description = $request->input('description');
            $material->category_id = $request->input('category_id'); 
            $material->type = $request->input('type'); 
            $material->save();
            

            return redirect('/material')->with('success','New Material Successfully Added!');
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
