<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class MaterialController extends Controller
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
                 'materials.isbn as isbn',
                'materials.type as type',
                'materials.title as title',
                'materials.author as author',
                'materials.description as description',
                'categories.name as name')
        ->join('categories','categories.id','=','materials.category_id')
        ->orderBy('materials.id', 'asc')
        ->paginate(10);

        $categories = Category::all();
        return view('pages\admin\material\index',compact("materials","categories"));
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
            $material->isbn = $request->input('isbn');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $table  = Material::where($where)->first();

        return Response::json($table);
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


        $material = Material::findOrFail($id);
        $material->title = $request->input('title2');
        $material->author = $request->input('author2');
        $material->description = $request->input('description2');
        $material->category_id = $request->input('category_id2');
        $material->type = $request->input('type2');
        $material->isbn = $request->input('isbn2');
        $material->save();


        return redirect('/material')->with('success','New Material Successfully Added!');

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
