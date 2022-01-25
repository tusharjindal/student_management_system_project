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
        $teachers=Teachers::leftJoin('users', 'users.id', '=', 'teachers.Tid')
        ->paginate(3);
        //$teachers = Teachers::all();  
        // $teachers = DB::table('teachers')
        // ->leftJoin('users', 'teachers.Tid', '=', 'users.id')
        // ->paginate(1);  
        return view('teachers.index', compact('teachers'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = DB::table('courses')->pluck("CourseName","Cid");
        return view('teachers.create',compact('courses'));
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
          
            'Tid' => 'required',
            'email' => 'required|email',
            'name' => 'required|min:4',
            'number' => 'required',
            'designation' => 'required',
            'courseid' => 'required',
            'speciality' => 'required',
            
        ]);

        $teacher=new Teachers();
        $teacher->Tid=$request->input('Tid');
       // $teacher->name=$request->input('name');
        //$teacher->email=$request->input('email');
        $teacher->number=$request->input('number');
        $teacher->designation=$request->input('designation');
        $teacher->courseid=$request->input('courseid');
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
        $user= User::find($id);   
       // $courses = DB::table('courses')->pluck("CourseName","Cid");
        return view('teachers.edit', compact('teacher'),compact('user')); 
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
        $this->validate($request, [
          
            'email' => 'required|email',
            'name' => 'required|min:4',
            'number' => 'required',
            'designation' => 'required',
            'speciality' => 'required',
            
        ]);

        $teacher = Teachers::find($Tid);  
        $teacher->number =$request->get('number');  
        $teacher->designation =$request->get('designation');  
        $teacher->speciality =$request->get('speciality');  
        $teacher->save();  

        $user = User::find($Tid);  
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
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
        $user = User::find($Tid); 
        $user->delete();
        return redirect('/home');
    }
}
