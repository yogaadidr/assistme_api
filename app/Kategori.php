<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'tbl_kategori';
    protected $fillable = ['nama_kategori','id_kategori_parent','jenis'];
    protected $hidden = ['created_at','updated_at'];
}
