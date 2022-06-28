<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactusController extends Controller
{
    public function contactusList()
    {
    
        return view ('admin.contactUsList');
    }
    
}
