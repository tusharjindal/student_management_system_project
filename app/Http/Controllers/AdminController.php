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
        $admins=Admin::leftJoin('users', 'users.id', '=', 'admins.adminid')
        ->paginate(3);
        // $admins = Admin::all();  
        // $admins = DB::table('admins')
        // ->leftJoin('users', 'admins.adminid', '=', 'users.id')
        // ->paginate(1);
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
        $this->validate($request, [
          
            'adminid' => 'required',
            'Email' => 'required|email',
            'Name' => 'required|min:4',
            'number' => 'required',
            'Address' => 'required',
            
        ]);

   

        // $admin=new Admin();
        // $admin->adminid=$request->input('adminid');
        // $admin->number=$request->input('number');
        // $admin->Address=$request->input('Address');
        // $admin->save();

        // $user=new User();
        // $user->id=$request->input('adminid');
        // $user->name=$request->input('Name');
        // $user->email=$request->input('Email');
        // $user->password = bcrypt('secret');
        // $user->role=0;
        // $user->save();

        DB::beginTransaction();
        try{
            $newAdmin= Admin::create([
                
                'adminid'=>Input::get('adminid'),
                'number'=>Input::get('number'),
                'Address'=>Input::get('Address')
                ]);

            $newUser = User::create([
                    'name' =>  Input::get('Name'),
                    'id' =>   Input::get('adminid'),
                    'email'=> Input::get('Email'),
                    'role'=>0,
                    'password' =>'secret'
                ]);
                
        }catch(ValidationException $e){
            DB::rollback();
            throw $e;
        }
            DB::commit();
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
        $user= User::find($id);  
        return view('admin.edit', compact('admin'),compact('user')); 
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

        $this->validate($request, [
          
            'Email' => 'required|email',
            'Name' => 'required|min:4',
            'number' => 'required',
            'address' => 'required',
            
        ]);

        $admin=Admin::find($id);  
        $admin->Address=$request->input('address');
        $admin->number=$request->input('number');
        $admin->save();
        $user=User::find($id);
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->save();
        $admin->save();
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
        $user=User::find($adminid);
        $user->delete();
        return redirect('/home');
    }
}
