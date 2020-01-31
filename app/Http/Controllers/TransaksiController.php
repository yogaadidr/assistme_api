<?php

namespace App\Http\Controllers;

use App\Http\Repository\TransaksiRepository;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected $transaksi;

    // constructor receives container instance
    public function __construct() {
        $this->transaksi = new TransaksiRepository();
    }

    public function list(Request $request) {
        $data = $request->input();
        $data['tanggal_awal'] = $this->getDateFromString($data['tanggal_awal']);
        $data['tanggal_akhir'] = $this->getDateFromString($data['tanggal_akhir']);

        $listTransaksi = $this->transaksi->list($data);
        $responseCode = 200;
        if(sizeof($listTransaksi) == 0){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTransaksi,$responseCode);
    }

    public function tambah(Request $request) {
        $data = $request->input();
        $listTransaksi = $this->transaksi->add($data);
        $responseCode = 200;
        if($listTransaksi != null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTransaksi,$responseCode);
    }

}