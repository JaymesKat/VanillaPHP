<?php
namespace VanillaPHP\Services;

class LocationService {
    
    public static function get_countries(){
        $url = 'http://services.groupkt.com/country/get/all';
        try {
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
            $response = utf8_decode(curl_exec($process));
            $results = json_decode($response);
            curl_close($process);
            if(isset($results)){
                return $results->RestResponse->result;
            } else {
                return array();
            }
        } catch(Exception $e){
            echo "Error: ".$e->getMessage();
            return array();
        }
    }

    public static function get_states($country_code){
        $url = "http://services.groupkt.com/state/get/$country_code/all";
        try {
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
            $response = utf8_decode(utf8_encode(curl_exec($process)));
            $results = json_decode($response);
            curl_close($process);
            if(isset($results)){
                return $results->RestResponse->result;
            } else {
                return array();
            }
        } catch(Exception $e){
            echo "Error: ".$e->getMessage();
            return array();
        }
    }
}
