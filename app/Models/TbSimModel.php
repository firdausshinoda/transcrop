<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbSimModel extends Model
{
    use HasFactory;
    protected $table = 'tb_sim';
    public $timestamps = false;

    protected $fillable = [
        'id_sim',
        'nama_sim',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
