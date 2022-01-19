<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Students;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        // $students = Students::paginate(2); 
        $students = DB::table('students')
        ->leftJoin('users', 'students.Studentid', '=', 'users.id')
        ->paginate(3);
        return view('students.index', compact('students'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = DB::table('courses')->pluck("CourseName","Cid");
        return view('students.create',compact('courses'));
        
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
            'Studentid' => 'required',
            'email' => 'required|email',
            'name' => 'required|min:4',
            'number' => 'required',
            'Address' => 'required',
            'courseid' => 'required',
            'Birth' => 'required',
            'Grades' => 'required',
            'Mentor' => 'required',
        ]);

        $student=new Students();
        $student->Studentid=$request->input('Studentid');
        //$student->name=$request->input('name');
        //$student->email=$request->input('email');
        $student->number=$request->input('number');
        $student->Birth=$request->input('Birth');
        $student->Address=$request->input('Address');
        $student->courseid=$request->input('courseid');
        $student->Grades=$request->input('Grades');
        $student->Mentor=$request->input('Mentor');
        $student->save();

        $user=new User();
        $user->id=$request->input('Studentid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = bcrypt('secret');
        $user->role=2;
        $user->save();
        return redirect('/home');
        //return view('admin.home');
        // Students::create($request->all());
        
        // return redirect()->route('home')->with('success','created successfully');
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
        $student= Students::find($id);  
        $user= User::find($id);  
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

        $student = Students::find($Studentid);  
        $student->number =$request->get('number');  
        $student->Birth =$request->get('Birth');  
        $student->Address =$request->get('Address');  
        $student->Grades =$request->get('Grades'); 
        $student->Mentor =$request->get('Mentor');   
        $student->save();  

        $user = User::find($Studentid);  
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
    public function destroy($Studentid)
    {
        $student=Students::find($Studentid);  
        $student->delete();  
        $user=User::find($Studentid); 
        $user->delete();
        return redirect('/home');
    }

   
}
