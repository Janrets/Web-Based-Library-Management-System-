<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;

class MerchantCategoryController extends Controller
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
        $categories  = DB::table('categories')->orderBy('id', 'desc')->paginate(10);
        return view('pages\merchant\category\index',compact("categories"));
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
            $category = new Category;
            $category->category_name = $request->input('category_name');
            $category->description = $request->input('description');
            $category->category_type = $request->input('category_type');
            $category->status = $request->input('status');
            if($request->hasfile('prof_image')){
                $file1 = $request->file('prof_image');
                $extension1 = $file1->getClientOriginalExtension();
                $origname = $file1->getClientOriginalName();
                $user1 = auth()->user()->name.'-'.auth()->user()->id;
                $filename1 = $user1.'category-prof_image'.time().'.'.$extension1;
                $file1->move('uploads/category/', $filename1);
                $category->profile_image = $filename1;
            }
            $category->save();

            return redirect('/merchant-category')->with('success','Category Information Successfully Added!');
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
        $category = Category::findOrFail($id);
        $category->category_name = $request->input('category_name2');
        $category->description = $request->input('description2');
        $category->category_type = $request->input('category_type2');
        $category->status = $request->input('status2');
        if($request->hasfile('prof_image2')){
            $file1 = $request->file('prof_image2');
            $extension1 = $file1->getClientOriginalExtension();
            $origname = $file1->getClientOriginalName();
            $user1 = auth()->user()->name.'-'.auth()->user()->id;
            $filename1 = $user1.'category-prof_image'.time().'.'.$extension1;
            $file1->move('uploads/category/', $filename1);
            $category->profile_image = $filename1;
        }
        $category->save();
        return redirect('/merchant-category')->with('success','Category Information Successfully Updated!');

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
            $categories = DB::table('categories')
            ->orderBy('id', 'desc')
            ->where('category_name','LIKE','%'.$search_text.'%')
            ->paginate(10)
            ->withQueryString();
            return view('pages\merchant\category\index',compact("categories"));
        }else{
            echo "Error 404|Page Not Found!";
        }

    }
}
