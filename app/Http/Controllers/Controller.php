<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    private function getMessageStatus($statusCode){
        if($statusCode == 200){
            return null;
        }else  if($statusCode == 201){
            return "Data berhasil ditambah";
        }else  if($statusCode == 404){
            return "Data tidak ditemukan";
        }else  if($statusCode == 500){
            return "Server error";
        }else{
            return null;
        }
    }

    public function getDateFromString($string_date){
        $year = date('Y',strtotime($string_date));
        $month = date('m',strtotime($string_date));
        $day = date('d',strtotime($string_date));
        $date = date('Y-m-d',strtotime($string_date));
        return array("year"=>$year,"month"=>$month,"day"=>$day,"date"=>$date);
    }

    public function responseWithJson($data,$statusCode = 200){
        
        $errMsg = $this->getMessageStatus($statusCode);
        $resp = array("statusCode"=>$statusCode,"error"=>$errMsg,"data"=>$data);
        return response()->json($resp);
        $response->getBody()->write(json_encode($resp));
        return $response
          ->withHeader('Content-Type', 'application/json')
          ->withStatus($statusCode);
    }
}
