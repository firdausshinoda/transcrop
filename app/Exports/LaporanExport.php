<?php

namespace App\Exports;

use App\Models\TbPemesananModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;


class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles {

    protected $tgl_dari, $tgl_sampai;

    function __construct($tgl_dari, $tgl_sampai) {
        $this->tgl_dari = $tgl_dari;
        $this->tgl_sampai = $tgl_sampai;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        $data =  TbPemesananModel::select('tb_pemesanan.kd_pemesanan','tb_cv.nama_cv','tb_user.nama_user','tb_pemesanan.deskripsi_barang','tb_pemesanan.alamat_berangkat','tb_pemesanan.alamat_tujuan','tb_pemesanan.deskripsi_berangkat','tb_pemesanan.deskripsi_tujuan','tb_pemesanan.total_kendaraan','tb_pemesanan.jarak','tb_pemesanan.berat_barang','tb_pemesanan.date_from','tb_pemesanan.time_from','tb_pemesanan.harga_tol','tb_pemesanan.harga_total','tb_pemesanan.stt_pemesanan')
            ->join('tb_user','tb_user.id_user','=','tb_pemesanan.id_user')
            ->join('tb_cv','tb_cv.id_cv','=','tb_pemesanan.id_cv')
            ->where(array('tb_pemesanan.del_flage'=>0));
        if (!empty($this->tgl_dari)) {
            $data->whereBetween('tb_pemesanan.created_at', [$this->tgl_dari, $this->tgl_sampai]);
        }
        return $data->latest('tb_pemesanan.id_pemesanan')->get();
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            ['Kode Pemesanan','Nama Perusahaan','Nama Pemesan','Barang','Alamat Jemput','Deskripsi Alamat Jemput','Alamat Tujuan','Deskripsi Alamat Tujuan','Jumlah Kendaraan','Jarak','Berat Barang','Tanggal Penjemputa','Waktu Penjemputan','Harga Tol','Harga Total','Status Pemesanan']
        ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
    }
    
}
