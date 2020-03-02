<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_superadmin');
    }

    public function index()
    {
        return view('sahome');
    }
}
