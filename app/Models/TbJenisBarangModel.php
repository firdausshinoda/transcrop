<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbJenisBarangModel extends Model
{
    use HasFactory;
    protected $table = 'tb_jenis_barang';
    public $timestamps = false;

    protected $fillable = [
        'id_jenis_barang',
        'jenis_barang',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
