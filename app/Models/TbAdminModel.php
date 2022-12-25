<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbAdminModel extends Model
{
    use HasFactory;
    protected $table = 'tb_admin';
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'username',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
