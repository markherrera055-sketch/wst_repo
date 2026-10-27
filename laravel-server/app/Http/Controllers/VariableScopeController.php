<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariableScopeController extends Controller
{
    public $course = "BSIT";

    public function index()
    {
        $student = "Mark Daniel Lambon Herrera";
        $message = "Helllo, World!";
    

        return response()->json([
            "student" => $student,
            "message" => $message,
            "course" => $this->course
        ]);
    }

    public function read()
    {
        $greetingsName = $this->greet("Mark");
        return response()->json([
            "course" => $this->course,
            "greetings" => $greetingsName
        ]);
    }

    public function greet($name)
    {
        return response() ->json([
            "message" => "Hello, $name!"
        ]);
    }
}
