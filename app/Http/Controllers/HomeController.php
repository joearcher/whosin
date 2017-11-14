<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScanService;

class HomeController extends Controller
{
    public function index(){
        return ScanService::doScan();
    }
}
