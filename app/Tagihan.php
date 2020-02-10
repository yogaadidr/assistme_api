<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tbl_tagihan';
    protected $fillable = ['nama_tagihan', 'nominal_tagihan','kategori'];
    protected $hidden = ['created_at','updated_at'];
}
