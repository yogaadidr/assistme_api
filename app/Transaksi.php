<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';
    protected $table = 'tbl_transaksi';
    protected $fillable = ['no_transaksi', 'tanggal_transaksi','nominal',
            'rekening_asal','rekening_tujuan','kategori','keterangan'];
    protected $hidden = ['created_at','updated_at'];
    public $incrementing = false;
}
