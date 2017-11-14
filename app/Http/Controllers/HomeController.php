<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScanService;

use App\Device;

class HomeController extends Controller
{
    public function index(){
        return view('home')->with(['devices' => Device::all()]);
    }
}
