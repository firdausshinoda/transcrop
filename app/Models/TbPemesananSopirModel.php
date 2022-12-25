<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbPemesananSopirModel extends Model
{
    use HasFactory;
    protected $table = 'tb_pemesanan_sopir';
    public $timestamps = false;

    protected $fillable = [
        'id_pemesanan_sopir',
        'id_pemesanan',
        'id_sopir',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
