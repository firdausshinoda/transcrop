<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbSopirModel extends Model
{
    use HasFactory;
    protected $table = 'tb_sopir';
    public $timestamps = false;

    protected $fillable = [
        'id_sopir',
        'id_cv',
        'id_user',
        'id_sim',
        'kd_supir',
        'password',
        'pengalaman',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
