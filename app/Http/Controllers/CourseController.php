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
    public function index(Request $request)
    {
        $course=new Courses();
        $courses = $course->fetch_all();  
        if ($request->ajax()) {
            return view('courses.index', compact('courses'));  
        }
        return view('courses.new', compact('courses'));  
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

        $input = [
            'Cid' =>Input::get('Studentid'),
            'CourseName'=>Input::get('CourseName') ,
         ];

        $course=new Courses();
        $course_added=$course->store($input);
        
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
        $find_course=new Courses();
        $course= $find_course->find($id);
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
  
        $this->validate($request, [
            'CourseName' => 'required|min:4',
        ]);

        $input = [
            'CourseName'=>Input::get('CourseName') ,
         ];

        $course=new Courses();
        $course->update($input, $Cid);
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
        $course=new Courses();
        $course->delete($Cid);
        return redirect('/home');
    }

    public function search_course(Request $request){

        $q=$request->input('q');
        $course=new Courses();
        $course1=$course->search($q);
        if($course1->count()>0){
            return view('courses.search_result')->withDetails($course1)->withQuery ($q);
        }
        else{
            return \redirect::back()->withMessage('No Details found. Try to search again !');
        }
    }
}
