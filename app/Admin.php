<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'adminid';
    public $incrementing = false;

    public function fetch_all(){
        $admins=Admin::leftJoin('users', 'users.id', '=', 'admins.adminid')
        ->paginate(3);
        return $admins;
    }

    public function find($id){
        $admin= Admin::find($id);  
        return $admin;
    }

    public function store($request){
        $admin=new Admin();
        $admin->adminid=$request->input('adminid');
        $admin->number=$request->input('number');
        $admin->Address=$request->input('Address');
        $admin->save();
        return $admin;
    }

    public function update($request,$id){
        $admin=Admin::find($id);  
        $admin->Address=$request->input('address');
        $admin->number=$request->input('number');
        $admin->save();
        return $admin;
    }

    public function delete($adminid){
        $admin=Admin::find($adminid);  
        $admin->delete();  
    }

    public function search($search){

        $admin = Admin::leftJoin('users','users.id', '=' , 'admins.adminid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $admin;
    }
}
