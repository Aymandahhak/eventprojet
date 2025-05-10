<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function registrations()
    {
        // Retrieve and pass registrations to the view
        return view('admin.registrations'); 
    }
}
