<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\User;
use DB;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$teachers = Teachers::all();  
        $teachers = DB::table('teachers')
        ->leftJoin('users', 'teachers.Tid', '=', 'users.id')
        ->paginate(1);  
        return view('teachers.index', compact('teachers'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher=new Teachers();
        $teacher->Tid=$request->input('Tid');
       // $teacher->name=$request->input('name');
        //$teacher->email=$request->input('email');
        $teacher->number=$request->input('number');
        $teacher->designation=$request->input('designation');
        $teacher->speciality=$request->input('speciality');
        $teacher->save();

        $user=new User();
        $user->id=$request->input('Tid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = bcrypt('secret');
        $user->role=1;
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
        $teacher= Teachers::find($id);  
        return view('teachers.edit', compact('teacher')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Tid)
    {
        $teacher = Teachers::find($Tid);  
       // $teacher->name =$request->get('name');  
      //  $teacher->email =$request->get('email');
        $teacher->number =$request->get('number');  
        $teacher->designation =$request->get('designation');  
        $teacher->speciality =$request->get('speciality');  
        $teacher->save();  
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Tid)
    {
        $teacher=Teachers::find($Tid);  
        $teacher->delete();  
        return redirect('/home');
    }
}
