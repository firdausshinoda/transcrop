<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbJenisKendaraanModel extends Model
{
    use HasFactory;
    protected $table = 'tb_jenis_kendaraan';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis_kendaraan',
        'jenis_kendaraan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
