<?php

namespace Helper;

class HumanoService
{
    private const BASE_URL = "http://68.178.160.51:8080";
        
    public static function getBimService($ref) 
    {
        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Accept: application/json",
                //"Authorization: " . HumanoService::AUTORIZATION_HEADER
            ],
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => HumanoService::BASE_URL . "/humano/synchEbax/getRapportBimService/" . $ref
        ]);
        
        $response = curl_exec($curl);

        $response = @json_decode($response,true);

        if(true) return $response;

        //if(!empty($response["data"])) return ["success" => true, "data" => $response["data"], "total" => $response["total"]];
     
        //return ["success" => false, "error_message" => "Unknown error"];
    }
}
