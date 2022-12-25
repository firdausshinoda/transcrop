<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbPengaturanModel extends Model
{
    use HasFactory;
    protected $table = 'tb_pengaturan';
    public $timestamps = false;

    protected $fillable = [
        'id_pengaturan',
        'nama',
        'deskripsi',
        'updated_at'
    ];
}
