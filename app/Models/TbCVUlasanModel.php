<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbCVUlasanModel extends Model
{
    use HasFactory;
    protected $table = 'tb_cv_ulasan';
    public $timestamps = false;

    protected $fillable = [
        'id_cv_ulasan',
        'id_pemesanan',
        'id_cv',
        'id_user',
        'ratting_ulasan',
        'isi_ulasan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
