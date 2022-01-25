<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];
    const ROLE_TYPE_ADMIN=0;
    const ROLE_TYPE_TEACHER=1;
    const ROLE_TYPE_STUDENT=2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','role', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function find($id){
        $user= User::find($id);  
        return $user;
    }

    public function store_student($request){
       
        $user=new User();
        $user->id=$request->input('Studentid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = 'secret';
        $user->role=2;
        $user->save();
        return $user;
    }

    public function update_user($request,$Studentid){

        $user = User::find($Studentid);  
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
        return $user;

    }

    public function store_teacher($request){
 
        $user=new User();
        $user->id=$request->input('Tid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = 'secret';
        $user->role=1;
        $user->save();
        return $user;
    }

    public function update_teacher($request,$Tid){

        $user = User::find($Tid);  
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
        return $user;
    }

    public function delete_student($Studentid){
        $user=User::find($Studentid); 
        $user->delete();
    }

    public function delete_teacher($Tid){
        $user = User::find($Tid); 
        $user->delete();
    }

    public function store_admin($request){
        $user=new User();
        $user->id=$request->input('adminid');
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->password = 'secret';
        $user->role=0;
        $user->save();
    }

    public function update_admin($request,$id){
        $user=User::find($id);
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->save();
        return $user;
    }

    public function delete_admin($adminid){
        $user=User::find($adminid);
        $user->delete();
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
