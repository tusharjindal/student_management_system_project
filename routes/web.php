<?php
use Illuminate\Support\Facades\Input;
use App\User;
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
Route::any('/search',function(){
    $q = Input::get ( 'q' );

    
    $student = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($student) > 0)
        return view('students.search_result')->withDetails($student)->withQuery ( $q );
    else return view ('students.search_result')->withMessage('No Details found. Try to search again !');
});