<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upah extends Model
{
    use SoftDeletes;

    protected $table = 'upah';

    protected $fillable = [
        'nama_barang', 'upah'
    ];
}
