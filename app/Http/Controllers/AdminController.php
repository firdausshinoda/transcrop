<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Models\TbBankModel;
use App\Models\TbCVModel;
use App\Models\TbJenisBarangModel;
use App\Models\TbJenisKendaraanModel;
use App\Models\TbKendaraanModel;
use App\Models\TbKritikSaranModel;
use App\Models\TbPemesananModel;
use App\Models\TbPemesananSopirModel;
use App\Models\TbPengaturanModel;
use App\Models\TbSimModel;
use App\Models\TbSopirModel;
use App\Models\TbUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    var $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    public function __construct() {
        $this->middleware(function ($request, $next){
            if (!Session::has('agrocar-admin')){
                return redirect(url('/'));
            }
            return $next($request);
        });
    }
    public function index(){
        $menunggu = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"MENUNGGU"))->count();
        $terkonfirmasi = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"TERKONFIRMASI"))->count();
        $pembayaran = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"PEMBAYARAN TERKONFIRMASI"))->count();
        $diantarkan = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"DIANTARKAN"))->count();
        $selesai = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"SELESAI"))->count();
        $ditolak = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"DITOLAK"))->count();
        $dibatalkan = TbPemesananModel::where(array('del_flage'=>0,'stt_pemesanan'=>"DIBATALKAN"))->count();
        $ttl = $menunggu+$terkonfirmasi+$pembayaran+$diantarkan+$selesai+$ditolak+$dibatalkan;
        $data['pemesanan_berjalan'][0][0] = round(($menunggu/$ttl)*100,2);
        $data['pemesanan_berjalan'][0][1] = $menunggu;
        $data['pemesanan_berjalan'][1][0] = round(($terkonfirmasi/$ttl)*100,2);
        $data['pemesanan_berjalan'][1][1] = $terkonfirmasi;
        $data['pemesanan_berjalan'][2][0] = round(($pembayaran/$ttl)*100,2);
        $data['pemesanan_berjalan'][2][1] = $pembayaran;
        $data['pemesanan_berjalan'][3][0] = round(($diantarkan/$ttl)*100,2);
        $data['pemesanan_berjalan'][3][1] = $diantarkan;
        $data['pemesanan_berjalan'][4][0] = round(($selesai/$ttl)*100,2);
        $data['pemesanan_berjalan'][4][1] = $selesai;
        $data['pemesanan_berjalan'][5][0] = round(($ditolak/$ttl)*100,2);
        $data['pemesanan_berjalan'][5][1] = $ditolak;
        $data['pemesanan_berjalan'][6][0] = round(($dibatalkan/$ttl)*100,2);
        $data['pemesanan_berjalan'][6][1] = $dibatalkan;


        $data['_month'] = $month = date('n');
        $data['_month_name'] = $this->bulan[$month];
        $data['ttl_user'] = TbUserModel::where('del_flage',0)->count();
        $data['ttl_kendaraan'] = TbKendaraanModel::where('del_flage',0)->count();
        $data['ttl_cv'] = TbCVModel::where('del_flage',0)->count();
        $data['ttl_sopir'] = TbSopirModel::where('del_flage',0)->count();
        $data['_year'] = TbPemesananModel::selectRaw('YEAR(created_at) as year')->where(array('stt_pemesanan'=>"SELESAI",'del_flage'=>0))->groupBy('year')->latest()->get();
        return view('admin/index',$data);
    }
    public function notifikasi(){
        $data['data'] = TbCVModel::where(array('stt_cv'=>"MENUNGGU",'del_flage'=>0))->latest('id_cv')->get();
        return view('admin/notifikasi',$data);
    }
    public function notifikasi_tolak($id){
        $data['id'] = $id;
        return view('admin/notifikasi_tolak',$data);
    }
    public function jenis_kendaraan(){
        $data['data'] = TbJenisKendaraanModel::where(array('del_flage'=>0))->latest('id_jenis_kendaraan')->get();
        return view('admin/jenis_kendaraan',$data);
    }
    public function jenis_kendaraan_tambah(){
        return view('admin/jenis_kendaraan_tambah');
    }
    public function jenis_kendaraan_ubah($id){
        $data['data'] = TbJenisKendaraanModel::where('id_jenis_kendaraan',$id)->first();
        return view('admin/jenis_kendaraan_ubah',$data);
    }
    public function jenis_barang(){
        $data['data'] = TbJenisBarangModel::where(array('del_flage'=>0))->latest('id_jenis_barang')->get();
        return view('admin/jenis_barang',$data);
    }
    public function jenis_barang_tambah(){
        return view('admin/jenis_barang_tambah');
    }
    public function jenis_barang_ubah($id){
        $data['data'] = TbJenisBarangModel::where('id_jenis_barang',$id)->first();
        return view('admin/jenis_barang_ubah',$data);
    }
    public function jenis_sim(){
        $data['data'] = TbSimModel::where(array('del_flage'=>0))->latest('id_sim')->get();
        return view('admin/jenis_sim',$data);
    }
    public function jenis_sim_tambah(){
        return view('admin/jenis_sim_tambah');
    }
    public function jenis_sim_ubah($id){
        $data['data'] = TbSimModel::where('id_sim',$id)->first();
        return view('admin/jenis_sim_ubah',$data);
    }
    public function bank(){
        $data['data'] = TbBankModel::where('del_flage',0)->latest('id_bank')->get();
        return view('admin/bank',$data);
    }
    public function bank_tambah(){
        return view('admin/bank_tambah');
    }
    public function bank_ubah($id){
        $data['data'] = TbBankModel::where('id_bank',$id)->first();
        return view('admin/bank_ubah',$data);
    }
    public function pemesanan(){
        $data['data'] = TbPemesananModel::select('tb_user.stt_login','tb_user.nama_user','tb_user.foto_user','tb_pemesanan.*')
            ->join('tb_user','tb_user.id_user','=','tb_pemesanan.id_user')
            ->where(array('tb_pemesanan.del_flage'=>0))
            ->latest('tb_pemesanan.id_pemesanan')->get();
        return view('admin/pemesanan',$data);
    }
    public function pemesanan_detail($id){
        $data['data'] = TbPemesananModel::select('tb_user.stt_login','tb_user.nama_user','tb_user.foto_user','tb_user.nik','tb_cv.nama_cv','tb_kendaraan.foto_kendaraan','tb_pemesanan.*')
            ->join('tb_user','tb_user.id_user','=','tb_pemesanan.id_user')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->join('tb_cv','tb_cv.id_cv','=','tb_pemesanan.id_cv')
            ->where('tb_pemesanan.id_pemesanan',$id)->first();
        $data['data_sopir'] = TbPemesananSopirModel::select('kd_sopir','tb_user.*')
            ->join('tb_sopir','tb_sopir.id_sopir','=','tb_pemesanan_sopir.id_sopir')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where('tb_pemesanan_sopir.id_pemesanan',$id)->get();
        return view('admin/pemesanan_detail',$data);
    }
    public function perusahaan(){
        $data['data'] = TbCVModel::where('stt_cv',"DITERIMA")->latest('id_cv')->get();
        return view('admin/perusahaan',$data);
    }
    public function perusahaan_detail($id){
        $data['data'] = TbCVModel::select('tb_user.nama_user','tb_cv.*')
            ->join('tb_user','tb_user.id_user','=','tb_cv.id_user')
            ->where('tb_cv.id_cv',$id)->first();
        $data['data_kendaraan'] = TbKendaraanModel::select('tb_kendaraan.*','tb_jenis_kendaraan.jenis_kendaraan')
            ->join('tb_jenis_kendaraan','tb_jenis_kendaraan.id_jenis_kendaraan','=','tb_kendaraan.id_jenis_kendaraan')
            ->where(array('tb_kendaraan.id_cv'=>$id,'tb_kendaraan.del_flage'=>0))->get();
        $data['data_sopir'] = TbSopirModel::select('tb_sopir.kd_sopir','tb_user.*')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where(array('tb_sopir.id_cv'=>$id,'tb_sopir.del_flage'=>0))->get();
        $data['data_pemesanan'] = TbPemesananModel::select('tb_user.stt_login','tb_user.nama_user','tb_user.foto_user','tb_pemesanan.*','tb_kendaraan.foto_kendaraan')
            ->join('tb_user','tb_user.id_user','=','tb_pemesanan.id_user')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->where(array('tb_pemesanan.del_flage'=>0,'tb_pemesanan.id_cv'=>$id))
            ->latest('tb_pemesanan.id_pemesanan')->get();
        return view('admin/perusahaan_detail',$data);
    }
    public function sopir(){
        $data['data'] = TbSopirModel::select('tb_user.*','tb_sopir.id_sopir','tb_sopir.kd_sopir')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where('tb_sopir.del_flage',0)->latest('tb_sopir.id_user')->get();
        return view('admin/sopir',$data);
    }
    public function sopir_detail($id){
        $data['data'] = TbSopirModel::select('tb_user.*','tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_sim.nama_sim')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->join('tb_sim','tb_sim.id_sim','=','tb_sopir.id_sim')
            ->where('tb_sopir.id_sopir',$id)->latest('tb_sopir.id_user')->first();
        return view('admin/sopir_detail',$data);
    }
    public function pengguna(){
        $data['data'] = TbUserModel::where('del_flage',0)->latest('id_user')->get();
        return view('admin/pengguna',$data);
    }
    public function pengguna_detail($id){
        $data['data'] = TbUserModel::where('id_user',$id)->first();
        return view('admin/pengguna_detail',$data);
    }
    public function kritik_saran(){
        $data['data'] = TbKritikSaranModel::where('del_flage',0)->latest('id_kritiksaran')->get();
        return view('admin/kritik_saran',$data);
    }
    public function laporan(Request $request){
        $data = array();
        if (!empty($request->tgl_dari)) {
            $data['filter'] = "?tgl_dari=".$request->tgl_dari."&tgl_sampai=".$request->tgl_sampai;
        } else {
            $data['filter'] = null;
        }
//        $data['data'] = TbKritikSaranModel::where('del_flage',0)->latest('id_kritiksaran')->get();
        return view('admin/laporan',$data);
    }
    public function cetak_statistik_pemesanan(Request $request) {
        $tgl_dari = $request->tgl_dari;
        $tgl_sampai = $request->tgl_sampai;
        return Excel::download(new LaporanExport($tgl_dari,$tgl_sampai),'Laporan Pemesanan.xlsx');
    }
    public function pengaturan(){
        $data['data'] = TbPengaturanModel::get();
        return view('admin/pengaturan',$data);
    }
    public function pengaturan_ubah($id){
        $data['data'] = TbPengaturanModel::where('id_pengaturan',$id)->first();
        return view('admin/pengaturan_ubah',$data);
    }
    public function akun(){
        return view('admin/akun');
    }

    public function keluar(){
        return redirect(url('/'));
    }
}
