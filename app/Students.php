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

    public function store($request){
        $student=new self();
        $student->Studentid=$request->input('Studentid');
        $student->number=$request->input('number');
        $student->Birth=$request->input('Birth');
        $student->Address=$request->input('Address');
        $student->courseid=$request->input('courseid');
        $student->Grades=$request->input('Grades');
        $student->Mentor=$request->input('Mentor');
        $student->save();
        return $student;
    }

    public function update($request,$Studentid){

        $student = self::find($Studentid);  
        $student->number =$request->get('number');  
        $student->Birth =$request->get('Birth');  
        $student->Address =$request->get('Address');  
        $student->Grades =$request->get('Grades'); 
        $student->Mentor =$request->get('Mentor');   
        $student->save();  
        return $student;

    }

    public function delete($Studentid){
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

