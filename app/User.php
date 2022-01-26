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

    public function store_student($input){
       
        $user=new self();
        $user->id=$input['Studentid'];
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_STUDENT;
        $user->save();
        return $user;
    }

    public function update_student($input,$Studentid){

        $user = self::find($Studentid);  
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->save();
        return $user;

    }

    public function store_teacher($input){
 
        $user=new self();
        $user->id=$input['Tid'];
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_TEACHER;
        $user->save();
        return $user;
    }

    public function update_teacher($input,$Tid){

        $user = self::find($Tid);  
        $user->name=$input('name');
        $user->email=$input('email');
        $user->save();
        return $user;
    }

    public function delete_user($id){
        $user=self::find($id); 
        $user->delete();
    }

 

    public function store_admin($input){
        $user=new self();
        $user->id=$input('adminid');
        $user->name=$input('Name');
        $user->email=$input('Email');
        $user->password = 'secret';
        $user->role=self::ROLE_TYPE_ADMIN;
        $user->save();
    }

    public function update_admin($input,$id){
        $user=self::find($id);
        $user->name=$input['Name'];
        $user->email=$input['Email'];
        $user->save();
        return $user;
    }

    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
