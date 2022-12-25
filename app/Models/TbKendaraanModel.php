<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKendaraanModel extends Model
{
    use HasFactory;
    protected $table = 'tb_kendaraan';
    public $timestamps = false;

    protected $fillable = [
        'id_kendaraan',
        'id_cv',
        'id_jenis_kendaraan',
        'nama_kendaraan',
        'harga_perkm',
        'foto_kendaraan',
        'ratting_kendaraan',
        'jenis_angkutan',
        'deskripsi_kendaraan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
