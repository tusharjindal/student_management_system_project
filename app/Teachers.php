<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $primaryKey = 'Tid';
    public $incrementing = false;

    public function fetch_all(){
        $teachers=Teachers::leftJoin('users', 'users.id', '=', 'teachers.Tid')
        ->paginate(3);
        return $teachers;
    }

    public function find($id){
        $teacher=Teachers::find($id); 
        return $teacher;
    }
    public function search($search){

        $teacher = Teachers::leftJoin('users','users.id', '=' , 'teachers.Tid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $teacher;
    }
}
