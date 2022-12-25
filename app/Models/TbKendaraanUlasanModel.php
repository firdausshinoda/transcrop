<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKendaraanUlasanModel extends Model
{
    use HasFactory;
    protected $table = 'tb_kendaraan_ulasan';
    public $timestamps = false;

    protected $fillable = [
        'id_kendaraan_ulasan',
        'id_pemesanan',
        'id_kendaraan',
        'id_user',
        'ratting_ulasan',
        'isi_ulasan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
