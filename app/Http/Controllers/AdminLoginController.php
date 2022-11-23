<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Illuminate\Support\Facades\DB;
use Session;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function login()
    {
        return view('auth\adminLogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admins = DB::table('users')
        ->where('email','=',$request->input('email'))
        // ->where('password','=',$request->input('password'))
        ->first();
        if($admins){
                $hasher = app('hash');
                if ($hasher->check($request->input('password'), $admins->password))
                {

                        if($admins){
                            session()->put('is_admin', 0);
                            session()->put('name', $admins->name);

                            return redirect('/dashboard');



                        }
                }else{
                    return redirect('/admin/login-page')->with('error','Email and Password Code Does Not Match!');

                }
            }else{
                return redirect('/admin/login-page')->with('error','Email Does Not Exist!');

            }

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
        //
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
}
