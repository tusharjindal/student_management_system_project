<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Courses;
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
        $teacher=new Teachers();
        $teachers=$teacher->fetch_all();
        return view('teachers.index', compact('teachers'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course=new Courses();
        $courses=$course->get_name_id();
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

        // $teacher=new Teachers();
        // $teacher->Tid=$request->input('Tid');
       // $teacher->name=$request->input('name');
        //$teacher->email=$request->input('email');
        // $teacher->number=$request->input('number');
        // $teacher->designation=$request->input('designation');
        // $teacher->courseid=$request->input('courseid');
        // $teacher->speciality=$request->input('speciality');
        // $teacher->save();

        // $user=new User();
        // $user->id=$request->input('Tid');
        // $user->name=$request->input('name');
        // $user->email=$request->input('email');
        // $user->password = bcrypt('secret');
        // $user->role=1;
        // $user->save();
        DB::beginTransaction();
        try{
            $newTeacher= Teachers::create([
                
                'Tid'=>Input::get('Tid'),
                'number'=>Input::get('number'),
                'designation'=>Input::get('designation'),
                'courseid'=>Input::get('courseid'),
                'speciality'=>Input::get('speciality')
                ]);

            $newUser = User::create([
                    'name' =>  Input::get('name'),
                    'id' =>   Input::get('Tid'),
                    'email'=> Input::get('email'),
                    'role'=>1,
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
        $teacher_find=new Teachers();
        $teacher= $teacher_find->find($id); 
        $user_find=new User();
        $user=$user_find->find($id);
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

    public function search_teacher(Request $request){

        $q=$request->input('q');
        $teacher=new Teachers();
        $teacher1=$teacher->search($q);
        if($teacher1->count()>0){
            return view('teachers.search_result')->withDetails($teacher1)->withQuery ($q);
        }
        else{
            return \redirect::back();
        }
    }
}
