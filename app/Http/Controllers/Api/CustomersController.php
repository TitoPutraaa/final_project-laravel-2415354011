<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request) {    
        $status = $request->query("status");         
        $query = customers::query();      
    }
}
