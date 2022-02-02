<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $primaryKey = 'Studentid';
    public $incrementing = false;
    protected $guarded = [];
   

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function fetch_all(){
        $students=self::leftJoin('users', 'users.id', '=', 'students.Studentid') 
        ->paginate(3);
        return $students;
    }

    public function fetch_all_api($page_number){

        if($page_number<0 || $page_number==null)
        {
        $page_number=1;
        }
        else if(is_float($page_number))
        {
            $page_number=(int)($page_number);  //floor
        }
       
        $students=self::select('users.name','users.email','students.Studentid','students.number','students.Birth','students.Address','students.Grades','students.Mentor')
        ->leftJoin('users', 'users.id', '=', 'students.Studentid')->offset($page_number)->limit(2)->get();
        
        return $students;
    }

    public function find_student($id){
        $student= self::find($id);  
        return $student;
    }

    public function findApiId($find_api_id)
    {
        $find_id = self::where('Studentid',$find_api_id)->first();
        return $find_id;
    }
    public function store($input){
        $student=new self();
        $student->Studentid=$input['Studentid'];
        $student->number=$input['number'];
        $student->Birth=$input['Birth'];
        $student->Address=$input['Address'];
        $student->courseid=$input['courseid'];
        $student->Grades=$input['Grades'];
        $student->Mentor=$input['Mentor'];
        $student->save();
        return $student;
    }

    public function update_student($input,$Studentid){

        $student = self::find($Studentid);  
        $student->number =$input['number'];  
        $student->Birth =$input['Birth'];  
        $student->Address =$input['Address'];  
        $student->Grades =$input['Grades']; 
        $student->Mentor =$input['Mentor'];   
        $student->save();  
        return $student;

    }

    public function delete_student($Studentid){
        $student=self::find($Studentid);  
        $student->delete();  
    }
    public function search($search){

        $student = self::leftJoin('users','users.id', '=' , 'students.Studentid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $student;
    }
}

