<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){

       echo "abcd";
 
    }

    public function profile($username){

        echo $username;


    }
}

