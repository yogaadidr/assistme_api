<?php

namespace App\Http\Repository;
use App\Rekening;
use Illuminate\Support\Facades\DB;

class RekeningRepository
{
    public function listAll(){
        return Rekening::where("no_rekening","<>","99")->get();
    }

    public function getRekening($norek){
        $rekening = Rekening::where('no_rekening', $norek)->first();
        return $rekening;
    }

    public function add($data) {
        $rekening = new Rekening;
        $rekening->no_rekening = $data['no_rekening'];
        $rekening->nama_rekening = $data['nama_rekening'];
        $rekening->save();
    }

    public function getSaldo($no_rekening) {
        $saldo = DB::table('v_saldo_rekening')
                     ->select('nama_rekening','saldo')
                     ->where('no_rekening', $no_rekening)
                     ->get();
        return $saldo;
    }

    public function getAllRekeningSaldo() {
        $saldo = DB::table('v_saldo_rekening')
                     ->select('no_rekening','nama_rekening','saldo')
                     ->get();
        return $saldo;
    }

    public function getAllSaldo() {
        $saldo = DB::table('v_saldo_rekening')
                    ->select(DB::raw('sum(saldo) as total_saldo'))
                     ->get();
        return $saldo;
    }

}