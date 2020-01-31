<?php

namespace App\Http\Repository;
use App\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiRepository
{
    public function list($data){
        // $queries = Capsule::getQueryLog();
        if($data['jenis'] == 'harian'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereDate('t.tanggal_transaksi', '>=',$data['tanggal_awal']['date'])
            // ->whereDate('t.tanggal_transaksi', '<=',$data['tanggal_akhir']['date'])
            ->get();
        }else if($data['jenis'] == 'bulanan'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereMonth('t tanggal_transaksi',$data['tanggal_awal']['month'])
            ->get();
        }else if($data['jenis'] == 'tahunan'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereYear('t.tanggal_transaksi',$data['tanggal_awal']['year'])
            ->get();
        }else{
            return null;
        }
        //return TransaksiModel::all();
    }

    public function listRange($jenis,$nilai){
        if($jenis == 'harian'){
            return Transaksi::where(DB::raw("date_format(tanggal_transaksi,'%Y%m%d') = date_format(sysdate(),'%Y%m%d')"));
        }else if($jenis == 'bulanan'){
            return Transaksi::where(DB::raw("date_format(tanggal_transaksi,'%Y%m') = date_format(sysdate(),'%Y%m')"));
        }else if($jenis == 'tahunan'){
            return Transaksi::where(DB::raw("date_format(tanggal_transaksi,'%Y') = date_format(sysdate(),'%Y')"));
        }
        return Transaksi::where(DB::raw("date_format(tanggal_transaksi,'%Y%m%d') = date_format(sysdate(),'%Y%m%d')"));
    }

    public function add($data) {
        $transaksi = new Transaksi;
        $transaksi->tanggal_transaksi = $data['tanggal_transaksi'];
        $transaksi->nominal = $data['nominal'];
        $transaksi->rekening_asal = $data['rekening_asal'];
        $transaksi->rekening_tujuan = $data['rekening_tujuan'];
        $transaksi->kategori = $data['kategori'];
        $transaksi->keterangan = $data['keterangan'];
        $transaksi->save();
    }

}