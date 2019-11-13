<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
      $students = Student::all() ;
      return view('students')->with('students',$students) ;
    }
    public function create()
    {
      return view('students')->with('option','create') ;
    }

    public function store(Request $request)
    {

    }

    public function show(Student $student)
    {

    }

    public function edit(Student $student)
    {

    }

    public function update(Request $request, Student $student)
    {

    }


    public function destroy(Student $student)
    {

    }
}
