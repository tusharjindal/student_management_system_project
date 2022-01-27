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
        $admin=new Admin();
        $admins=$admin->fetch_all();
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


        DB::beginTransaction();
        try{

            $input = [
                'adminid'=>Input::get('adminid'),
                'number'=>Input::get('number'),
                'Address'=>Input::get('Address'),
                'Name'=>Input::get('Name') ,
                'Email'=>Input::get('Email'),
             ];

            $admin = new Admin();
            $new_admin = $admin->store($input);

            $user=new User();
            $new_user = $user->store_admin($input);
            // $newAdmin= Admin::create([
                
            //     'adminid'=>Input::get('adminid'),
            //     'number'=>Input::get('number'),
            //     'Address'=>Input::get('Address')
            //     ]);

            // $newUser = User::create([
            //         'name' =>  Input::get('Name'),
            //         'id' =>   Input::get('adminid'),
            //         'email'=> Input::get('Email'),
            //         'role'=>0,
            //         'password' =>'secret'
            //     ]);
                
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
        $admin_find= new Admin();
        $admin=$admin_find->find_admin($id);
        $user_find=new User();
        $user=$user_find->find_user($id);
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

        DB::beginTransaction();
        try{

            $input = [
                'number'=>Input::get('number'),
                'Address'=>Input::get('Address'),
                'Name'=>Input::get('Name') ,
                'Email'=>Input::get('Email'),
             ];

            $admin = new Admin();
            $new_admin = $admin->update_admin($input,$id);

            $user=new User();
            $new_user = $user->update_admin($input,$id);
      
        }catch(ValidationException $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
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
        DB::beginTransaction();
        try{
            $admin = new Admin();
            $admin->delete_admin($adminid);

            $user=new User();
            $user->delete_user($adminid);
      
        }catch(ValidationException $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect('/home');
    }

    public function search_admin(Request $request){

        $q=$request->input('q');
        $admin=new Admin();
        $admin1=$admin->search($q);
        if($admin1->count()>0){
            return view('admin.search_result')->withDetails($admin1)->withQuery ($q);
        }
        else{
            return \redirect::back();
        }
    }
}
