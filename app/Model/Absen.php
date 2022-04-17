<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    use SoftDeletes;

    protected $table = 'absen';

    protected $fillable = [
        'no_pegawai', 'tanggal_hadir', 'masuk', 'keluar'
    ];
}
