<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbCVModel extends Model
{
    use HasFactory;
    protected $table = 'tb_cv';
    public $timestamps = false;

    protected $fillable = [
        'id_cv',
        'id_user',
        'kd_cv',
        'nama_cv',
        'deskripsi_cv',
        'foto_cv',
        'password',
        'email_cv',
        'alamat_cv',
        'skdp',
        'siup',
        'ratting_cv',
        'lt_cv',
        'lg_cv',
        'nama_bank',
        'norek_bank',
        'an_bank',
        'stt_cv',
        'stt_ulasan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
