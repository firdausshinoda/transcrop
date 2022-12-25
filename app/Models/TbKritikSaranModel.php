<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKritikSaranModel extends Model
{
    use HasFactory;
    protected $table = 'tb_kritiksaran';
    public $timestamps = false;

    protected $fillable = [
        'id_kritiksaran',
        'email',
        'nama',
        'no_hp',
        'isi',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
