<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbBankModel extends Model
{
    use HasFactory;
    protected $table = 'tb_bank';
    public $timestamps = false;

    protected $fillable = [
        'id_bank',
        'nama_bank',
        'foto_bank',
        'an_bank',
        'norek_bank',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
