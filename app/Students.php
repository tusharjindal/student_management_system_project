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

    public function find($id){
        $student= self::find($id);  
        return $student;
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

