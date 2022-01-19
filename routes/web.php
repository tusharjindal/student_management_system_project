<?php
use Illuminate\Support\Facades\Input;
use App\User;
use App\Courses;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('students', 'StudentController');
Route::resource('teachers', 'TeacherController');
Route::resource('courses', 'CourseController');
Route::resource('admins', 'AdminController');
Route::get('/admin/home', 'HomeController@admin_index');
Route::get('/student/home', 'HomeController@student_index');
Route::get('/teacher/home', 'HomeController@teacher_index');
Route::get('/newhome','HomeController@role');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/showprofile','HomeController@ShowProfile');

Route::any('/studentsearch',function(){
    $q = Input::get ( 'q' );
    $student = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($student) > 0)
        return view('students.search_result')->withDetails($student)->withQuery ( $q );
    else return view ('students.search_result')->withMessage('No Details found. Try to search again !');
});

Route::any('/teachersearch',function(){
    $q = Input::get ( 'q' );
    $teacher = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($teacher) > 0)
        return view('teachers.search_result')->withDetails($teacher)->withQuery ( $q );
    else return view ('teachers.search_result')->withMessage('No Details found. Try to search again !');
});

Route::any('/coursesearch',function(){
    $q = Input::get ( 'q' );
    $course = Courses::where('CourseName','LIKE','%'.$q.'%')->get();
    if(count($course) > 0)
        return view('courses.search_result')->withDetails($course)->withQuery ( $q );
    else return view ('courses.search_result')->withMessage('No Details found. Try to search again !');
});

Route::any('/adminsearch',function(){
    $q = Input::get ( 'q' );
    $admin = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($admin) > 0)
        return view('admin.search_result')->withDetails($admin)->withQuery ( $q );
    else return view ('admin.search_result')->withMessage('No Details found. Try to search again !');
});