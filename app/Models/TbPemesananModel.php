<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbPemesananModel extends Model
{
    use HasFactory;
    protected $table = 'tb_pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'id_pemesanan',
        'id_cv',
        'id_user',
        'id_bank',
        'id_kendaraan',
        'kd_pemesanan',
        'harga',
        'harga_tol',
        'harga_total',
        'alamat_berangkat',
        'alamat_tujuan',
        'lt_berangkat',
        'lg_berangkat',
        'lt_tujuan',
        'lg_tujuan',
        'deskripsi_berangkat',
        'deskripsi_tujuan',
        'deskripsi_barang',
        'total_kendaraan',
        'jarak',
        'berat_barang',
        'date_from',
        'time_from',
        'foto_pembayaran',
        'avoid',
        'memo_pdf',
        'stt_pemesanan',
        'isi_ulasan',
        'ratting_ulasan',
        'created_at',
        'updated_at',
        'deleted_at',
        'del_flage'
    ];
}
