<?php

namespace App\Http\Controllers\Admin;

use App\MaterialFile;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class MaterialFileController extends Controller
{
    //
    public function material_file_view(Request $request){

        $school_id = request('school_id') ;
        $level_id  = request('level_id') ;
        $year_id    = request('year_id');

        $material_id = request('material_id'); 
        $class_id = request('class_id'); 


        $files = MaterialFile::where('type','file')->get() ; 
        $videos = MaterialFile::where('type','video')->get() ; 
        return view('admin.material_files_class' ,compact([
            'school_id' , 'level_id' , 'year_id' , 'class_id','material_id' , 'files', 'videos'
            ])) ; 
    }
    // image for pdf(text)
    public function add_material_file(Request $request){

        $this->validate(request(), [
            'file' => 'required',
            'material_id' => 'required',
            'class_id' => 'required',
        ]);
        $file = $request->file;         
        $fileName = time().'.'.$file->getClientOriginalName();
        $file->move(public_path('images'), $fileName); 

        MaterialFile::create([

            'image'=>$fileName ,
            'file_name'=> pathinfo(Input::file('file')->getClientOriginalName(), PATHINFO_FILENAME),
            'type'=>'file' ,
            'material_id'=>request('material_id') ,
            'class_id'=>request('class_id') ,

            ]);

        return redirect()->back()->with(['success_insert'=>'File Inserted Successfully']);

    }

    // download images or files (pdf) 
    public function dowload_material_file()
    {
        $this->validate(request(), [
            'id' => 'required',
        ]);

        $file  = MaterialFile::find(request('id'));
        //PDF file is stored under project/public/images/
        $file_path= public_path(). '/images/'. $file->image ;
        return response()->download($file_path);
    }

    // delete images or files (pdf) 
    public function delete_material_file()
    {
        $this->validate(request(), [
            'id' => 'required',
        ]);

        $file  = MaterialFile::find(request('id'));

        if(File::exists(public_path('images/'.$file->image))) {
            File::delete( public_path('images/'.$file->image));
        }

    }


}
