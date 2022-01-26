<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $primaryKey = 'Tid';
    public $incrementing = false;

    public function fetch_all(){
        $teachers=self::leftJoin('users', 'users.id', '=', 'teachers.Tid')
        ->paginate(3);
        return $teachers;
    }

    public function find($id){
        $teacher=self::find($id); 
        return $teacher;
    }

    public function store($input){

        $teacher=new self();
        $teacher->Tid=$input['Tid'];
        $teacher->number=$input['number'];
        $teacher->designation=$input['designation'];
        $teacher->courseid=$input['courseid'];
        $teacher->speciality=$input['speciality'];
        $teacher->save();
        return $teacher;
    }

    public function update_teacher($input,$Tid){

        $teacher = self::find($Tid);  
        $teacher->number=$input['number'];
        $teacher->designation=$input['designation'];
        $teacher->speciality=$input['speciality'];
        $teacher->save();  
        return $teacher;

    }

    public function delete_teacher($Tid){
        $teacher=self::find($Tid);  
        $teacher->delete();  
    }

    public function search($search){

        $teacher = self::leftJoin('users','users.id', '=' , 'teachers.Tid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $teacher;
    }
}
