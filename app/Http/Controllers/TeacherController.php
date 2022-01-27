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

     
        DB::beginTransaction();
        try{

            $input = [

                'Tid'=>Input::get('Tid'),
                'number'=>Input::get('number'),
                'designation'=>Input::get('designation'),
                'courseid'=>Input::get('courseid'),
                'speciality'=>Input::get('speciality'),
                'name'=>Input::get('name') ,
                'email'=>Input::get('email'),
             ];

            $teacher = new Teachers();
            $new_teacher = $teacher->store($input);

            $user=new User();
            $new_user = $user->store_teacher($input);

            // $newTeacher= Teachers::create([
                
            //     'Tid'=>Input::get('Tid'),
            //     'number'=>Input::get('number'),
            //     'designation'=>Input::get('designation'),
            //     'courseid'=>Input::get('courseid'),
            //     'speciality'=>Input::get('speciality')
            //     ]);

            // $newUser = User::create([
            //         'name' =>  Input::get('name'),
            //         'id' =>   Input::get('Tid'),
            //         'email'=> Input::get('email'),
            //         'role'=>1,
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
        $teacher_find=new Teachers();
        $teacher= $teacher_find->find_teacher($id); 
        $user_find=new User();
        $user=$user_find->find_user($id);
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

        DB::beginTransaction();
        try{

            $input = [

                'number'=>Input::get('number'),
                'designation'=>Input::get('designation'),
                'courseid'=>Input::get('courseid'),
                'speciality'=>Input::get('speciality'),
                'name'=>Input::get('name') ,
                'email'=>Input::get('email'),
             ];

            $teacher = new Teachers();
            $new_teacher = $teacher->update_teacher($input,$Tid);

            $user=new User();
            $new_user = $user->update_teacher($input,$Tid);
      
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
    public function destroy($Tid)
    {
        DB::beginTransaction();
        try{

            $teacher = new Teachers();
            $teacher->delete_teacher($Tid);

            $user=new User();
            $user->delete_user($Tid);
      
        }catch(ValidationException $e){
            DB::rollback();
            throw $e;
        }
        DB::commit();
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
