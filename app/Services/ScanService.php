<?php
namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScanService {

    public function process($result){
        
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