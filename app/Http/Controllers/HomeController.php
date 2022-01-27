<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Admin;
use DB;
use App\Teachers;
use App\Students;
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
        $name = Auth::user()->name;
        if ($role == User::ROLE_TYPE_ADMIN) 
        {
            return view('admin.home',compact('name'));
        } 
        else if($role ==User::ROLE_TYPE_TEACHER ) 
        {
            return view('teachers.home',compact('name'));
        }
        else if($role ==User::ROLE_TYPE_STUDENT) 
        {
            return view('students.home',compact('name'));
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
        $name = Auth::user()->name;
            if ($role == User::ROLE_TYPE_ADMIN) 
            {
                return view('admin.home',compact('name'));
            } 
            else if($role ==User::ROLE_TYPE_TEACHER ) 
            {
                return view('teachers.home',compact('name'));
            }
            else if($role ==User::ROLE_TYPE_STUDENT) 
            {
                return view('students.home',compact('name'));
            }
            else
            {
                return view('home');
            }
       
    }
    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function ShowProfile(){

        //echo  Auth::user();
        $role = Auth::user()->role;
        $id= Auth::user()->id;
        
       
            if ($role == User::ROLE_TYPE_ADMIN) 
            {
                $admins= Admin::find($id); 
                $find_user=new User(); 
                $user=$find_user->find($id);
                return view('admin.showprofile', compact('admins'),compact('user')); 
            } 
            else if($role ==User::ROLE_TYPE_TEACHER ) 
            {
                $find_teacher=new Teachers(); 
                $teachers=$find_teacher->find($id); 
                $find_user=new User(); 
                $user=$find_user->find($id); 
                return view('teachers.showprofile', compact('teachers'),compact('user')); 
            }
            else if($role ==User::ROLE_TYPE_STUDENT) 
            {
                $find_student=new Students(); 
                $students=$find_student->find($id); 
                $find_user=new User(); 
                $user=$find_user->find($id);  
                return view('students.showprofile', compact('students'),compact('user')); 
            }
            else
            {
                return view('home');
            }
    }
}
