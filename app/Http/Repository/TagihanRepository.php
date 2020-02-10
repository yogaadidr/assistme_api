<?php

namespace App\Http\Repository;
use App\Tagihan;
use Illuminate\Support\Facades\DB;

class TagihanRepository
{
    public function listAll(){
        return Tagihan::all();
    }

    public function getTagihan($id_tagihan){
        return Tagihan::where('id_tagihan', '=', $id_tagihan)->firstOrFail();
    }

    public function add($data) {
        $tagihan = new Tagihan;
        $tagihan->nama_tagihan = $data['nama_tagihan'];
        $tagihan->nominal_tagihan = $data['nominal_tagihan'];
        $tagihan->kategori = $data['kategori'];
        $tagihan->jenis_tagihan = $data['jenis_tagihan'];
        $tagihan->save();
    }

    public function addDetail($data){
        $result = DB::table('tbl_detail_tagihan')->insert([
            ['id_tagihan' => $data['id_tagihan'], 'id_transaksi' => $data['id_transaksi']]
        ]);
        return $result;
    }

    public function delete($id){
        $anggaran = Tagihan::find($id);
        return $anggaran->delete();
    }

    public function getDetailTagihan($tanggal){

        $subquery = DB::table('tbl_transaksi')
        ->select('*')
        ->whereMonth('tanggal_transaksi', $tanggal['month'])
        ->whereYear('tanggal_transaksi', $tanggal['year']);

        return DB::table('tbl_tagihan as a')
            ->select("a.id_tagihan","a.nama_tagihan","a.nominal_tagihan",DB::raw("coalesce(sum(c.nominal),0) jumlah"),"c.tanggal_transaksi","d.nama_kategori")
            ->leftjoin("tbl_detail_tagihan as b",'a.id_tagihan','=','b.id_tagihan')
            ->join("tbl_kategori as d",'a.kategori','=','d.id_kategori')
            ->leftjoinsub($subquery,'c',function($join){
                $join->on('b.id_transaksi', '=', 'c.no_transaksi');
            })
            ->groupBy("a.id_tagihan")->get();
    }

}