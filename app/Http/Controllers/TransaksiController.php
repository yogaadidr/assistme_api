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

    public function rekap(Request $request) {
        $data = $request->input();
        $tanggal = $this->getDateFromString($data['periode']);
        $periode = $tanggal['month'].'/'.$tanggal['year'];
        $listTransaksi = $this->transaksi->rekap($periode);
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
        if($listTransaksi == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTransaksi,$responseCode);
    }

    public function rekapDetail(Request $request) {
        $data = $request->input();
        $tanggal = $this->getDateFromString($data['periode']);
        $jenis = $data['jenis'];
        $listTransaksi = $this->transaksi->rekapDetail($tanggal,$jenis);
        $responseCode = 200;
        if($listTransaksi == null){
            $responseCode = 404;
        }
        return $this->responseWithJson($listTransaksi,$responseCode);
    }

}