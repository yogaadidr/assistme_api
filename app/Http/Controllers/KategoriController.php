<?php

namespace App\Http\Controllers;

use App\Http\Repository\KategoriRepository;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $kategori;
    public function __construct()
    {
        $this->kategori = new KategoriRepository();
    }
    public function list(Request $request) {
        $listKategori = $this->kategori->listAll();
        $responseCode = 200;
        if($listKategori == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listKategori,$responseCode);
    }

    public function listJenis($jenis, Request $request) {
        $listKategori = $this->kategori->listByJenis($jenis);

        if($jenis == 'tagihan'){
            $listKategori = $this->kategori->listKategoriTagihan();
        }
        $responseCode = 200;
        if($listKategori == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listKategori,$responseCode);
    }

    public function tambah(Request $request) {
        $data = $request->input();
        $this->kategori->add($data);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

}