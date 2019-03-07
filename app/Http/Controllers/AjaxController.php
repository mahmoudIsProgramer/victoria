<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function get_grades(Request $request)
    {
        $validator = $this->validate(request(), [
            'id' => 'required|in:1,2,3,4,5,6',
            'qty' => 'required',
            'type' => 'required',
        ]);

        $school = School::find(request('id')) ; 
        $grades = $school->grades ; 
        return response()->json(['success'=>'asd','total_cart'=>$total_cart,'total_gift'=>$total_gift]);

    }
}
