<?php
namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon\Carbon;

use DB, Log;

class ScanService {

    public static function process($result){
        Log::notice('results', $result);
        DB::table('devices')->whereIn('mac', $result)->update(['is_in' => true, 'updated_at' => Carbon::now()]);
        DB::table('devices')->whereNotIn('mac', $result)->update(['is_in' => false, 'updated_at' => Carbon::now()]);
        return true;
    }

    public static function doScan(){
        $process = new Process('sudo /usr/bin/arp-scan -l -q -t 1000 | egrep -ho "[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}"
        ');
            
        try {
    
            $process->mustRun();
            $response = $process->getOutput();
            $macs = explode("\n", $response);
            array_pop($macs);
            return $macs;
            
        } catch (ProcessFailedException $e) {

            Lo::info($e->getMessage());
    
        } 
    }
}