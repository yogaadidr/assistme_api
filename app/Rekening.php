<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'tbl_rekening';
    protected $fillable = ['no_rekening', 'nama_rekening'];
    protected $hidden = ['created_at','updated_at'];
}
