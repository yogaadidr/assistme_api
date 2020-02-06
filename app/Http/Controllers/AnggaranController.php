<?php

namespace App\Http\Controllers;

use App\Http\Repository\AnggaranRepository;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    protected $anggaran;
    public function __construct()
    {
        $this->anggaran = new AnggaranRepository();
    }

    public function list(Request $request) {
        $listAnggaran = $this->anggaran->getDetailAnggaran();
        $responseCode = 200;
        if($listAnggaran == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listAnggaran,$responseCode);
    }

    public function getAnggaran($id_anggaran, Request $request) {
        $listAnggaran = $this->anggaran->getAnggaran($id_anggaran);
        $responseCode = 200;
        if($listAnggaran == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listAnggaran,$responseCode);
    }
    
    public function tambah(Request $request) {
        $data = $request->input();
        $this->anggaran->add($data);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

    public function hapus($id_anggaran,Request $request) {
        $data = $this->anggaran->delete($id_anggaran);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

}