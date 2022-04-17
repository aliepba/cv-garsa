<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;

    protected $table = 'pegawai';

    protected $fillable = [
        'no_pegawai', 'nama', 'alamat', 'tanggal_lahir',
        'kelamin', 'kontak', 'jabatan_id', 'photo'
    ];

}
