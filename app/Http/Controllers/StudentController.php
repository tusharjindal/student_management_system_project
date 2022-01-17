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
        ->paginate(1);
        return view('students.index', compact('students'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $student=new Students();
        $student->Studentid=$request->input('Studentid');
        //$student->name=$request->input('name');
        //$student->email=$request->input('email');
        $student->number=$request->input('number');
        $student->Birth=$request->input('Birth');
        $student->Address=$request->input('Address');
       // $student->Course=$request->input('Course');
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
        return view('students.edit', compact('student'));  
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
        $student = Students::find($Studentid);  
        //$student->name =$request->get('name');  
        //$student->email =$request->get('email');
        $student->number =$request->get('number');  
        $student->Birth =$request->get('Birth');  
        $student->Address =$request->get('Address');  
        //$student->Course =$request->get('Course');  
        $student->Grades =$request->get('Grades'); 
        $student->Mentor =$request->get('Mentor');   
        $student->save();  
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
        return redirect('/home');
    }
}
