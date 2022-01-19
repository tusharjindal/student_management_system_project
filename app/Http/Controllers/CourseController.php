<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Courses::all();  
  
        return view('courses.index', compact('courses'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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
          
            'Cid' => 'required',
            'CourseName' => 'required|min:4',

            
        ]);

        $course=new Courses();
        $course->Cid=$request->input('Cid');
        $course->CourseName=$request->input('CourseName');
        $course->save();
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
        $course= Courses::find($id);  
        return view('courses.edit',compact('course'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Cid)
    {
        // $request->validate([  
        //     'CourseName'=>'required'
        // ]);  
  
        $this->validate($request, [
            'CourseName' => 'required|min:4',
        ]);
        
        $course = Courses::find($Cid);  
        $course->CourseName =$request->get('CourseName');  
        $course->save();  
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Cid)
    {
        $course=Courses::find($Cid);  
        $course->delete();  
        return redirect('/home');
    }
}
