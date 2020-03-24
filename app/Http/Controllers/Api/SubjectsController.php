<?php

namespace EDU\Http\Controllers\Api;

use Illuminate\Http\Request;
use EDU\Http\Controllers\Controller;
use EDU\Models\Subject;

class SubjectsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('q');

        return $search ? Subject::where('name','LIKE', '%'.$search.'%')->get():[];

    }
}
