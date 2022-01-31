<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Students;
use App\Courses;
use App\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $student = new Students();
        $students=$student->fetch_all();
        if ($request->ajax()) {
            return view('students.index', compact('students'));
        }
        return view('students.new',compact('students'));
        // $student=new Students();
        // $students=$student->fetch_all();
        // return view('students.index', compact('students'));  
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
        return view('students.create',compact('courses'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
      

        try{

            $input = [
                'Studentid' =>Input::get('Studentid'),
                'number' =>Input::get('number'),
                'Birth' =>Input::get('Birth'),
                'Address' =>Input::get('Address'),
                'courseid' =>Input::get('courseid'),
                'Grades'=>Input::get('Grades'),
                'Mentor'=>Input::get('Mentor') ,
                'name'=>Input::get('name') ,
                'email'=>Input::get('email'),
             ];

            DB::beginTransaction();

            $student = new Students();
            $new_student = $student->store($input);

            $user=new User();
            $new_user = $user->store_student($input);

            DB::commit();
            return redirect('/home');
            // $newStudent= Students::create([
            //         'Studentid'=> Input::get('Studentid'),
            //         'number'=> Input::get('number'),
            //         'Birth'=> Input::get('Birth'),
            //         'Address'=> Input::get('Address'),
            //         'courseid'=> Input::get('courseid'),
            //         'Grades'=> Input::get('Grades'),
            //         'Mentor'=> Input::get('Mentor')
            //     ]);

            // $newUser = User::create([
            //         'name' =>  Input::get('name'),
            //         'id' =>   Input::get('Studentid'),
            //         'email'=> Input::get('email'),
            //         'role'=>2,
            //         'password' =>'secret'
            //     ]);
                
        }catch(Exception $e){
            DB::rollback();
            throw $e;
            return redirect('/home');

        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      

        $student_find= new Students();
        $student=$student_find->find_student($id);
        $user_find=new User();
        $user=$user_find->find_user($id);
        return view('students.edit', compact('student'),compact('user'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Studentid)
    {
        $this->validate($request, [
          
            'email' => 'required|email',
             'name' => 'required|min:4',
            'number' => 'required',
            'Address' => 'required',
            'Birth' => 'required',
            'Grades' => 'required',
           'Mentor' => 'required',
        ]);

       
        try{
            DB::beginTransaction();
            $input = [

                'number' =>Input::get('number'),
                'Birth' =>Input::get('Birth'),
                'Address' =>Input::get('Address'),
                'Grades'=>Input::get('Grades'),
                'Mentor'=>Input::get('Mentor') ,
                'name'=>Input::get('name') ,
                'email'=>Input::get('email'),
             ];

            $student = new Student();
            $new_student = $student->update_student($input,$Studentid);

            $user=new User();
            $new_user = $user->update_student($input,$Studentid);
            DB::commit();
            return redirect('/home');
      
        }catch(Exception $e){
            DB::rollback();
            return redirect('/home')->with('error', 'failed to update current student');

        }
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Studentid)
    {
       
        try{

            DB::beginTransaction();
            $student = new Students();
            $student->delete_student($Studentid);

            $user=new User();
            $user->delete_user($Studentid);

            DB::commit();
            return redirect('/home');
      
        }catch(Exception $e){
            DB::rollback();
            throw $e;
            return redirect('/home');

        }
       
    }

    public function search_student(Request $request){

        $q=$request->input('q');
        $student=new Students();
        $student1=$student->search($q);
        if($student1->count()>0){
            return view('students.search_result')->withDetails($student1)->withQuery ($q);
        }
        else{
            return \redirect::back();
        }
    }
   
}
