<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbChatModel extends Model
{
    use HasFactory;
    protected $table = 'tb_chat';
    public $timestamps = false;

    protected $fillable = [
        'id_chat',
        'kd_chat',
        'id_user_send',
        'id_user_receiver',
        'isi',
        'send_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
