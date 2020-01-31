<?php

namespace App\Http\Repository;
use App\Kategori;
use Illuminate\Support\Facades\DB;

class KategoriRepository
{
    public function listAll(){
        return Kategori::all();
    }

    public function listByJenis($jenis){
        return Kategori::where("jenis",'like','%'.$jenis.'%')
            ->get();
    }

    public function add($data) {
        $kategori = new Kategori;
       // $kategori->id_kategori = $data['id_kategori'];
        $kategori->nama_kategori = $data['nama_kategori'];
        $kategori->id_kategori_parent = $data['id_kategori_parent'];
        $kategori->jenis = $data['jenis'];
        $kategori->save();
    }

}