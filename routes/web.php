<?php

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
    
    if(\Auth::check()){
        dd('authenticateed'); 
    }else{
        dd(' not authenticateed'); 
    }

    return view('welcome');
});


Route::group(['prefix' => 'admin' ,'middleware'=>'admin'] , function () {
        
        // add student routes 
        Route::get('/add_student', 'Admin\StudentController@add_student');
        Route::post('/add_student_post', 'Admin\StudentController@add_student_post');
        Route::get('/get_classes', 'Admin\StudentController@get_classes');
        
        // add teacher  routes 
        Route::get('/add_teacher', 'Admin\TeacherController@add_teacher');
        Route::post('/add_teacher_post', 'Admin\TeacherController@add_teacher_post');
        Route::get('/get_years', 'Admin\TeacherController@get_years');
        Route::get('/teacher/get_classes', 'Admin\TeacherController@get_classes');

        // set schedule for teachers and classes 
        // Route::get('/scheduleView', 'AdminController@scheduleView');
        Route::post('/set_schedule', 'Admin\ScheduleController@set_schedule'); // ajax route 
        Route::get('/schedule/teachers_on_material', 'Admin\ScheduleController@teachers_on_material');// ajax route 
    
        // start  materials files routes 

        Route::get('/material_file_view/{school_id}/{level_id}/{year_id}/{class_id}/{material_id}', 'Admin\MaterialFileController@material_file_view');


        Route::post('/add_material_file', 'Admin\MaterialFileController@add_material_file');
        Route::post('/add/video', 'Admin\MaterialFileController@addvideo');
        Route::get('/delete/materialfile/{id}', 'Admin\MaterialFileController@deletematerialfile');

        Route::post('/dowload_material_file', 'Admin\MaterialFileController@dowload_material_file');
        Route::post('/delete_material_file', 'Admin\MaterialFileController@delete_material_file');
        
        Route::post('/add/homework', 'Admin\MaterialFileController@addhomework');
        Route::get('/delete/homework/{id}', 'Admin\MaterialFileController@deletehomework');

        // end  materials files routes 

        Route::get('{unknown?}/schools/{school_id}', 'Admin\TeacherStudentController@schools');
        Route::get('{unknown?}/levels/{school_id}', 'Admin\TeacherStudentController@levels');
        Route::get('{unknown?}/years/{school_id}/{level_id}', 'Admin\TeacherStudentController@years');
        Route::get('{unknown?}/classes/{school_id}/{level_id}/{year_id}', 'Admin\TeacherStudentController@classes');
        Route::get('{unknown?}/materials/{school_id}/{level_id}/{year_id}/{class_id}', 'Admin\TeacherStudentController@materials_for_materialfiles');
        Route::get('/materials/{school_id}/{level_id}/{year_id}', 'Admin\TeacherStudentController@materials');
        
    
        // display materails to  show teachers on each material 
        Route::get('{unknown?}/materials_teachers/{school_id}/{level_id}/{year_id}', 'Admin\TeacherStudentController@materials');


        // this route come after (schools => levels => years => classes => materials(optional) ) to determin where you will go 
        Route::get('{unknown?}/action/in/class/{school_id}/{level_id}/{year_id}/{class_id}', 'Admin\TeacherStudentController@allevents');

    
        // Route::get('materials/{school_id}/{level_id}/{year_id}', 'Admin\TeacherStudentController@materials');
        
        Route::get('teachers_on_material/{school_id}/{level_id}/{year_id}/{material_id}', 'Admin\TeacherStudentController@teachers_on_material');
        
        Route::post('/add/attendance', 'Admin\TeacherStudentController@addattendance');
        Route::get('/all/attendance', 'Admin\TeacherStudentController@allattendance');

});      

Route::group(['prefix'=>'user' ,'middleware' => 'guest'], function() {
    Route::get('login', 'Auth\Authcontroller@login_get')->name('login');
    Route::post('login', 'Auth\Authcontroller@login_post');
});

Route::post('user/logout', 'Auth\Authcontroller@logout')->name('logout');

Route::group(['prefix' => 'teacher' ,'middleware'=>'teacher'] , function () {


    Route::get('/home' , 'TeacherController@home');

    Route::get('{unknown?}/schools/{school_id}', 'TeacherController@schools');
    Route::get('{unknown?}/levels/{school_id}', 'TeacherController@levels');
    Route::get('{unknown?}/years/{school_id}/{level_id}', 'TeacherController@years');
    Route::get('{unknown?}/classes/{school_id}/{level_id}/{year_id}', 'TeacherController@classes');
    Route::get('{unknown?}/action/in/class/{school_id}/{level_id}/{year_id}/{class_id}', 'TeacherController@allevents');

    Route::post('/add/attendance', 'TeacherController@addattendance');
    Route::get('/all/attendance', 'TeacherController@allattendance');
    Route::get('/profile', 'TeacherController@teacherprofile');
    Route::get('/my/schedules', 'TeacherController@myschedules');

    Route::post('/add/file', 'TeacherController@addfile');
    Route::post('/add/video', 'TeacherController@addvideo');
    Route::post('/add/homework', 'TeacherController@addhomework');
    Route::get('/delete/materialfile/{id}', 'TeacherController@deletematerialfile');
    Route::get('/delete/homework/{id}', 'TeacherController@deletehomework');



    Route::get('materials/{school_id}/{level_id}/{year_id}', 'TeacherController@materials');

    Route::get('teachers_on_material/{school_id}/{level_id}/{year_id}/{material_id}', 'TeacherController@teachers_on_material');

    Route::get('/show/class/result' , 'TeacherController@showclassresult');
    Route::post('/add/degree' , 'TeacherController@adddegree');
    Route::post('/edit/degree' , 'TeacherController@editdegree');

});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
