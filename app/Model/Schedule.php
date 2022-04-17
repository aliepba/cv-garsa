<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedule';

    protected $fillable = [
       'id_absen', 'no_pegawai', 'upah_id', 'jumlah', 'tanggal_hadir'
    ];
}
