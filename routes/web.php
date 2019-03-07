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
        Route::get('/add_student', 'AdminController@add_student');
        Route::post('/add_student_post', 'AdminController@add_student_post');
        Route::get('/get_classes', 'AdminController@get_classes');
        
        
        // add teacher  routes 
        Route::get('/add_teacher', 'Admin\TeacherController@add_teacher');
        Route::post('/add_teacher_post', 'Admin\TeacherController@add_teacher_post');
        Route::get('/get_years', 'Admin\TeacherController@get_years');
        Route::get('/teacher/get_classes', 'Admin\TeacherController@get_classes');
        
        Route::group(['prefix' => 'student'], function () {
            
            Route::get('schools/{school_id}', 'Admin\StudentController@schools');
            Route::get('levels/{school_id}', 'Admin\StudentController@levels');
            Route::get('years/{school_id}/{level_id}', 'Admin\StudentController@years');
            Route::get('classes/{school_id}/{level_id}/{year_id}', 'Admin\StudentController@classes');
            Route::get('students_on_class/{school_id}/{level_id}/{year_id}/{classe_id}', 'Admin\StudentController@students_on_class');

        });
        // Route::get('teachers_on_school/{school_id}/{level_id}/{year_id}/{classe_id}', 'AdminController@teachers_on_school');
        
        Route::prefix('teacher')->group(function () {

            Route::get('schools/{school_id}', 'Admin\TeacherController@schools');
            Route::get('levels/{school_id}', 'Admin\TeacherController@levels');
            Route::get('years/{school_id}/{level_id}', 'Admin\TeacherController@years');
            Route::get('materials/{school_id}/{level_id}/{year_id}', 'Admin\TeacherController@materials');
            Route::get('teachers_on_material/{school_id}/{level_id}/{year_id}/{material_id}', 'Admin\TeacherController@teachers_on_material');

        });
});      

Route::group(['prefix'=>'user' ,'middleware' => 'guest'], function() {
    Route::get('login', 'Auth\Authcontroller@login_get')->name('login');
    Route::post('login', 'Auth\Authcontroller@login_post');
});

Route::post('user/logout', 'Auth\Authcontroller@logout')->name('logout');




// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
