<?php

namespace EDU\Http\Controllers\Admin;

use EDU\Models\ClassInformation;
use Illuminate\Http\Request;
use EDU\Http\Controllers\Controller;

class ClassStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ClassInformation $class_information)
    {
        if(!$request->ajax()) {
            return view('admin.class_informations.class_student', compact('class_information'));
        } else {
            return $class_information->students()->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}