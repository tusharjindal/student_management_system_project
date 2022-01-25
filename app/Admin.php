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
    public function search($search){

        $admin = Admin::leftJoin('users','users.id', '=' , 'admins.adminid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $admin;
    }
}
