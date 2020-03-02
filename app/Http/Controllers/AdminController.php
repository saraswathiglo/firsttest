<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function _construct(){
    	$this->middleware('auth');
    	$this->middleware('role:ROLE_admin');
    }
    public function index()
    {
        return view('ahome');
    }
}
