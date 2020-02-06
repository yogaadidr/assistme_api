<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $primaryKey = 'id_anggaran';
    protected $table = 'tbl_anggaran';
    protected $fillable = ['nama_anggaran','nominal_anggaran','tipe','kategori','valid'];
    protected $hidden = ['created_at','updated_at'];
}
