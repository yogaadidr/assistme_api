<?php

namespace App\Http\Repository;
use App\Anggaran;
use Illuminate\Support\Facades\DB;

class AnggaranRepository
{
    public function listAll(){
        return Anggaran::all();
    }

    public function getAnggaran($id_anggaran){
        return Anggaran::where('id_anggaran', '=', $id_anggaran)->firstOrFail();
    }

    public function add($data) {
        $anggaran = new Anggaran;
        $anggaran->nama_anggaran = $data['nama_anggaran'];
        $anggaran->nominal_anggaran = $data['nominal_anggaran'];
        $anggaran->tipe = $data['tipe'];
        $anggaran->valid = $data['valid'];
        $anggaran->kategori = $data['kategori'];
        $anggaran->save();
    }

    public function delete($id){
        $anggaran = Anggaran::find($id);
        return $anggaran->delete();
    }

    public function getDetailAnggaran(){
        return DB::table('v_prosentase_anggaran')->select('*')->get();
    }

}