<?php
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\APIBaseController as APIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Students;
use App\User;
class StudentAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id=$request->input('Studentid');
        $page=$request->input('page_number');
        $page_size=$request->input('page_size');
    
        if($id!=null)
    {
        $validator = Validator::make($request->all(), [ 'Studentid'=>'required', ]);
        if ($validator->fails()) {    
            return $this->sendError('Student ID is required');
        }
        try{
        $id=$request->input('Studentid');
        $student1 = new Students();
        $result=$student1->findApiId($id);
        if($result==null){
            return $this->sendError('failed to find the student');
        }
        else{
        return $this->sendResponse($result,'Students retrieved successfully.');
        }
        }catch(Exception $e){
        return $this->sendError('something went wrong');
        }
    }

    else{
        try{
        $student1 = new Students();
        $students=$student1->fetch_all_api($page,$page_size);
        if($students==null){
            return $this->sendError('failed to find any student');
        }
        else{

            $student = new Students();
            $TotalRecords = $student->count_students();
            $pageNumberCurrent = $page;
            $pageSizeCurrent = $page_size;
            $total_pages = ceil($TotalRecords/$pageSizeCurrent);
            $pageNumberNext = $pageNumberCurrent + 1;

            if($pageNumberNext >=$total_pages )
            $nextLink = null;
            else    
            $nextLink = 'http://localhost:8000/api/students?page_number='.$pageNumberNext.'&page_size='.$pageSizeCurrent;
            $pageNumberPrevious = $pageNumberCurrent - 1;
            
            if($pageNumberPrevious < 1)
                $previousLink = null;
            else
                $previousLink = 'http://localhost:8000/api/students?page_number='.$pageNumberPrevious.'&page_size='.$pageSizeCurrent;
            
            return $this->sendResponse_all_students($students,$previousLink,$nextLink,$pageSizeCurrent,$total_pages,'Students retrieved successfully.');
        }
        }catch(Exception $e){
            return $this->sendError('something went wrong');
        }
    }
      
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [ 
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

            if ($validator->fails()) {    
                return $this->sendError('Enter details correctly');
            }

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
            return $this->sendResponse($new_student,'Students created successfully.');
                
        }catch(Exception $e){
            DB::rollback();
        
            return $this->sendResponse('failed to create student');

        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
