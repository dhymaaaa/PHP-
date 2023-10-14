<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function list(){
        // return App\Models\Students::all();
        return Student::all();
    }

    public function getStudent($ID){
        $student = Student::find($ID);
        if($student == null){
            return response()->json('Student not found', 404);
        }
        return $student;
    }

    public function create(Request $request){
        //return $request->all();

        // $student = new Student;
        // $student->first_name = $request->first_name;
        // $student->last_name = $request->last_name;
        // $student->save();

        $student = Student::create($request->all());
        return $student;

    }

    public function updateStudent(Request $request, $ID){
        $student = Student::find($ID);
        if($student == null){
            return response()->json('Student not found', 404);
        }
        $student->fill($request->all())->save();
        return $student;
    }

    public function deleteStudent($ID){
        $student = Student::find($ID);
        if($student == null){
            return response()->json('Student not found', 404);
        }
        $student->delete();
        return $student;
    }
}
