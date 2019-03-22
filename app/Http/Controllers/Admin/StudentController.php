<?php

namespace App\Http\Controllers\Admin;

use App\Year;
use App\Level;
use App\Classe;
use App\School;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{

    // start add student 
    public function add_student(Request $request )
    {
        $years = Year::where('school_id',1)->get();
        return view('admin.add_student',compact('years'));
    }
    public function add_student_post(Request $request )
    {
        $this->validate(request(), [
            
            'name' => 'required',
            'username' => 'required|unique:students',
            'email' => 'nullable|email',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
            'phone' => 'nullable|numeric|regex:/(01)[0-9]{9}/',
            'school_id' => 'required',
            // 'level_id' => 'required',
            'class_id' => 'required',
            
        ]);

        $inputs = request()->except(['_token','confirmpassword']); 
        if(request()->image){

            $image = $request->image;         
            $imageName = time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $imageName); 
            $inputs['image'] = $imageName;
        }

        Student::create($inputs);
        return redirect()->back()->with(['success_insert'=>'Success Added student']);

    }
    // assign class to student 
    public function get_classes(Request $request )
    {
        $classes = Classe::where('year_id',request('year_id'))->get(); 
        $options = '' ; 
        foreach ($classes as $class ){
            $options.= "<option value='$class->id' >" . $class->name .  '</option>';
        }
        return response()->json(['options'=>$options]);
    }
    // end add Student 
}
