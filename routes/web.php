<?php

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $process = new Process('sudo /usr/bin/arp-scan -l');
    
    try {
        $process->mustRun();
        $response = (string)$process->getOutput();
        preg_match_all("/\b[[:xdigit:]]{2}-[[:xdigit:]]{2}-[[:xdigit:]]{2}-[[:xdigit:]]{2}-[[:xdigit:]]{2}-[[:xdigit:]]{2}\b/su", $response, $matches);
        print_r($matches[0]);
    } catch (ProcessFailedException $e) {
       echo $e->getMessage();

    } 
});