<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'adminid';
    public $incrementing = false;

    public function fetch_all(){
        $admins=self::leftJoin('users', 'users.id', '=', 'admins.adminid')
        ->paginate(3);
        return $admins;
    }

    public function find($id){
        $admin= self::find($id);  
        return $admin;
    }

    public function store($input){
        $admin=new self();
        $admin->adminid=$input('adminid');
        $admin->number=$input('number');
        $admin->Address=$input('Address');
        $admin->save();
        return $admin;
    }

    public function update_admin($input,$id){
        $admin=self::find($id);  
        $admin->Address=$input['address'];
        $admin->number=$input['number'];
        $admin->save();
        return $admin;
    }

    public function delete_admin($adminid){
        $admin=self::find($adminid);  
        $admin->delete();  
    }

    public function search($search){

        $admin = self::leftJoin('users','users.id', '=' , 'admins.adminid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $admin;
    }
}
