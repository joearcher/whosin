<?php
namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use DB;

class ScanService {

    public static function process($result){
        DB::table('devices')->whereIn('mac', $result)->update(['is_in' => true]);
        DB::table('devices')->whereNotIn('mac', $result)->update(['is_in' => false]);
        return true;
    }

    public static function doScan(){
        $process = new Process('sudo /usr/bin/arp-scan -l -q | egrep -ho "[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}"
        ');
            
        try {
    
            $process->mustRun();
            $response = $process->getOutput();
            $macs = explode("\n", $response);
            array_pop($macs);
            return $macs;
            
        } catch (ProcessFailedException $e) {
            echo $e->getMessage();
    
        } 
    }
}