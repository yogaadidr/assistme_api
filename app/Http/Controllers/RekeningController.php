<?php

namespace App\Http\Controllers;

use App\Http\Repository\RekeningRepository;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    protected $rekening;
    public function __construct()
    {
        $this->rekening = new RekeningRepository();
    }
    public function list(Request $request) {
        $listrekening = $this->rekening->listAll();
        $responseCode = 200;
        if($listrekening == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listrekening,$responseCode);
    }

    public function getRekening($norek,Request $request) {
        $listrekening = $this->rekening->getRekening($norek);
        $responseCode = 200;
        if($listrekening == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listrekening,$responseCode);
    }

    public function tambah(Request $request) {
        $data = $request->input();
        $this->rekening->add($data);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

    public function getSaldo(Request $request) {
        $data = $request->input();
        $isrekening = false;
        if($data['no_rekening'] == 'ALL'){
            $listSaldo = $this->rekening->getAllSaldo();
        }else if($data['no_rekening'] == 'rekening') {
            $listSaldo = $this->rekening->getAllRekeningSaldo();
            $isrekening = true;
        }else{
            $listSaldo = $this->rekening->getSaldo($data['no_rekening']);
        }
        $responseCode = 200;
        if($listSaldo == null){
            $responseCode = 404;
        }
        if($isrekening){
            return $this->responseWithJson($listSaldo,$responseCode);
        }
        return $this->responseWithJson($listSaldo[0],$responseCode);
    }
}