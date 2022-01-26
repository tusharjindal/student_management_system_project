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
        $user= self::find($id);  
        return $user;
    }

    public function store_student($request){
       
        $user=new self();
        $user->id=$request->input('Studentid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_STUDENT;
        $user->save();
        return $user;
    }

    public function update_user($request,$Studentid){

        $user = self::find($Studentid);  
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
        return $user;

    }

    public function store_teacher($request){
 
        $user=new self();
        $user->id=$request->input('Tid');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_TEACHER;
        $user->save();
        return $user;
    }

    public function update_teacher($request,$Tid){

        $user = self::find($Tid);  
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->save();
        return $user;
    }

    public function delete_student($Studentid){
        $user=self::find($Studentid); 
        $user->delete();
    }

    public function delete_teacher($Tid){
        $user = self::find($Tid); 
        $user->delete();
    }

    public function store_admin($request){
        $user=new self();
        $user->id=$request->input('adminid');
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_ADMIN;
        $user->save();
    }

    public function update_admin($request,$id){
        $user=self::find($id);
        $user->name=$request->input('Name');
        $user->email=$request->input('Email');
        $user->save();
        return $user;
    }

    public function delete_admin($adminid){
        $user=self::find($adminid);
        $user->delete();
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
