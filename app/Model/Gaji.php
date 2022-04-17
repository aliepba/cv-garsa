<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gaji extends Model
{
    use SoftDeletes;

    protected $table = 'gaji';

    protected $fillable = [
        'no_pegawai', 'tgl_mulai', 'tgl_selesai',
        'total_absen', 'total_korosok', 'total_pk20',
        'total_pk40', 'total_pkk20', 'total_pkk40',
        'total_gaji'
    ];
}
