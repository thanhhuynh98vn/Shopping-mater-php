<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticalController extends Controller
{
    public function countProducts(){
        return view('admin.statistical.index');
    }
}
