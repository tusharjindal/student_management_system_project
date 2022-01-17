<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $role = Auth::user()->role;
        if ($role == User::ROLE_TYPE_ADMIN) 
        {
            return view('admin.home');
        } 
        else if($role ==User::ROLE_TYPE_TEACHER ) 
        {
            return view('teachers.home');
        }
        else if($role ==User::ROLE_TYPE_STUDENT) 
        {
            return view('students.home');
        }
        else
        {
            return view('home');
        }
    }
    public function admin_index()
    {
        return view('admin.home');
    }

    public function student_index()
    {
        return view('students.home');
    }

    public function teacher_index()
    {
        return view('teachers.home');
    }

    public function role()
    {
        $role = Auth::user()->role;
        
            if ($role == User::ROLE_TYPE_ADMIN) 
            {
                return view('admin.home');
            } 
            else if($role ==User::ROLE_TYPE_TEACHER ) 
            {
                return view('teachers.home');
            }
            else if($role ==User::ROLE_TYPE_STUDENT) 
            {
                return view('students.home');
            }
            else
            {
                return view('home');
            }
       
    }
}
