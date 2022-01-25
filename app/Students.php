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

    public function FetchAll(){
        $students=Students::leftJoin('users', 'users.id', '=', 'students.Studentid')
        ->paginate(3);
        return $students;
    }
    public function search($search){

        $student = Students::leftJoin('users','users.id', '=' , 'students.Studentid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $student;
    }
}

