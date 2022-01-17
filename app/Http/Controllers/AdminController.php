<?php

namespace App\Http\Controllers;
use App\Admin;
use App\User;
use Validator;
use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();  
        $admins = DB::table('admins')
        ->leftJoin('users', 'admins.adminid', '=', 'users.id')
        ->paginate(1);
        return view('admin.index', compact('admins'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [

            'Name'=>'required',
            'Email' => 'required|email|unique',]);

        $admin=new Admin();
        $admin->adminid=$request->input('adminid');
        //$admin->Name=$request->input('Name');
        //$admin->Email=$request->input('Email');
        $admin->number=$request->input('number');
        $admin->Address=$request->input('Address');
        $admin->save();

        $user=new User();
        $user->id=$request->input('adminid');
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->password = bcrypt('secret');
        $user->role=0;
        $user->save();
        return redirect('/home');
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
        $admin= Admin::find($id);  
        return view('admin.edit', compact('admin')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $adminid)
    {
        $admin= Admin::find($adminid);  
       // $admin->Name=$request->input('Name');
       /// $admin->Email=$request->input('Email');
        $admin->number=$request->input('number');
        $admin->Address=$request->input('Address');
        $admin->save();
    
        // $user=User::find();
        // $user->Name=$request->input('Name');
        // $user->Email=$request->input('Email');
        // $user->password = bcrypt('secret');
        // $user->role=0;
        // $user->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($adminid)
    {
        $admin=Admin::find($adminid);  
        $admin->delete();  
        return redirect('/home');
    }
}
