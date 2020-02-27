<?php

namespace App\Http\Repository;
use App\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiRepository
{
    public function list($data){
        // $queries = Capsule::getQueryLog();
        $rekening = '%';
        if(isset($data['rekening'])){
            $rekening = $data['rekening'];
        }
        if($data['jenis'] == 'harian'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereDate('t.tanggal_transaksi', '>=',$data['tanggal_awal']['date'])
            ->whereDate('t.tanggal_transaksi', '<=',$data['tanggal_akhir']['date'])
            ->Where(function($query) use ($rekening)
            {
                $query->where('t.rekening_asal', 'like', $rekening)
                      ->orWhere('t.rekening_tujuan', 'like', $rekening);
            })
            // ->whereDate('t.tanggal_transaksi', '<=',$data['tanggal_akhir']['date'])
            ->get();
        }else if($data['jenis'] == 'bulanan'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereMonth('t tanggal_transaksi',$data['tanggal_awal']['month'])
            ->Where(function($query) use ($rekening)
            {
                $query->where('t.rekening_asal', 'like', $rekening)
                      ->orWhere('t.rekening_tujuan', 'like', $rekening);
            })
            ->get();
        }else if($data['jenis'] == 'tahunan'){
            return DB::table('tbl_transaksi as t')
            ->select("t.*","a.nama_kategori","a.jenis","b.nama_rekening as nama_rekening_asal","c.nama_rekening as nama_rekening_tujuan")
            ->join("tbl_kategori as a",'t.kategori','=','a.id_kategori')
            ->join("tbl_rekening as b",'t.rekening_asal','=','b.no_rekening')
            ->join("tbl_rekening as c",'t.rekening_tujuan','=','c.no_rekening')
            ->whereYear('t.tanggal_transaksi',$data['tanggal_awal']['year'])
            ->Where(function($query) use ($rekening)
            {
                $query->where('t.rekening_asal', 'like', $rekening)
                      ->orWhere('t.rekening_tujuan', 'like', $rekening);
            })
            ->get();
        }else{
            return null;
        }
        //return TransaksiModel::all();
    }

    public function rekap($periode){
        return DB::table('v_rekap_transaksi')
            ->select("*")
            ->where('tanggal_pemasukan', '=',$periode)
            ->orWhere('tanggal_pengeluaran', '=',$periode)
            ->get();    
    }

    public function rekapDetail($periode,$jenis){
        $per = $periode['month'].'/'.$periode['year'];
        return DB::table('v_rekap_detail_inout')
            ->select("*")
            ->where('periode', '=',$per)
            ->where('jenis', '=',$jenis)
            ->get();    
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
        $last_trans = $this->getLastTransaction();
        foreach($last_trans as $trans);
        return $trans['no_transaksi'];
    }

    public function getLastTransaction() {
        $randomUser = Transaksi::orderBy('no_transaksi', 'desc')->take(1)
        ->get();
        return $randomUser;
    }

}