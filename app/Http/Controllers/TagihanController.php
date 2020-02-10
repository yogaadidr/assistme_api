<?php

namespace App\Http\Controllers;

use App\Http\Repository\TagihanRepository;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    protected $tagihan;
    public function __construct()
    {
        $this->tagihan = new TagihanRepository();
    }

    public function list(Request $request) {
        $tanggal = $this->getDateFromString(date('Y-m-d'));
        $listTagihan = $this->tagihan->getDetailTagihan($tanggal);
        $responseCode = 200;
        if($listTagihan == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTagihan,$responseCode);
    }

    public function getTagihan($id_tagihan, Request $request) {
        $listTagihan = $this->tagihan->getTagihan($id_tagihan);
        $responseCode = 200;
        if($listTagihan == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTagihan,$responseCode);
    }
    
    public function tambah(Request $request) {
        $data = $request->input();
        $this->tagihan->add($data);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

    public function tambahDetail(Request $request) {
        $data = $request->input();
        $this->tagihan->addDetail($data);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }

    public function hapus($id_tagihan,Request $request) {
        $data = $this->tagihan->delete($id_tagihan);
        $responseCode = 200;
        return $this->responseWithJson($data,200);
    }
    public function hapusPeriode($id_tagihan,Request $request) {
        $data = $request->input();
        $resp = $this->tagihan->deletePeriode($id_tagihan);
        $responseCode = 200;
        return $this->responseWithJson($resp,200);
    }

}