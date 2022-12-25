<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbUserModel extends Model
{
    use HasFactory;
    protected $table = 'tb_user';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_fb',
        'id_google',
        'token_firebase',
        'kd_user',
        'email_user',
        'password',
        'nama_user',
        'jenis_kelamin',
        'foto_user',
        'nik',
        'alamat_user',
        'lt_user',
        'lg_user',
        'stt_verifikasi',
        'stt_login',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
