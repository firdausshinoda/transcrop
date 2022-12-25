<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\TbAdminModel;
use App\Models\TbBankModel;
use App\Models\TbCVModel;
use App\Models\TbJenisBarangModel;
use App\Models\TbJenisKendaraanModel;
use App\Models\TbKritikSaranModel;
use App\Models\TbPemesananModel;
use App\Models\TbPengaturanModel;
use App\Models\TbSimModel;
use App\Models\TbSopirModel;
use App\Models\TbUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class ApiAdminController extends Controller
{

    var $message_failed_update = "Gagal mengubah data. Silahkan coba lagi beberapa saat...";
    var $message_failed_save = "Gagal menyimpan data. Silahkan coba lagi beberapa saat...";

    public function api_login(Request $request) {
        $where['username'] = $request->username;
        $where['password'] = md5($request->password);
        $stmt = TbAdminModel::where($where);
        if ($stmt->count() > 0) {
            $dt = $stmt->first();
            $session['id_admnin'] = $dt->id_admnin;
            $session['username'] = $dt->username;
            $session['agrocar-admin'] = true;
            Session::put($session);
            return $this->setJson("OK",url('/admin'));
        } else {
            return $this->setJson("ERROR",null,"Username atau password tidak ditemukan");
        }
    }

    public function api_notifikasi_konfirmasi(Request $request) {
        $where['id_cv'] = $request->id;
        $update['stt_cv'] = "DITERIMA";
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbCVModel::where($where)->update($update);
        if ($stmt) {
            $dt = TbCVModel::select('tb_cv.*','tb_user.nama_user','tb_user.email_user')
                ->join('tb_user','tb_user.id_user','=','tb_cv.id_user')
                ->where(array('tb_cv.id_cv'=>$request->id))
                ->first();
            $to_body = "Pendaftaran Peneyedia Jasa Anda Telah di Terima dengan Kode Penyedia Jasa ".$dt->kd_cv;
            $to_email = $dt->email_user;
            $to_nama = $dt->nama_user;
            $data = array('nama'=>$to_nama, "body" => $to_body);
            Mail::send('other.mail', $data, function($message) use ($to_nama, $to_email) {
                $message->to($to_email, $to_nama)
                    ->subject('INFO PENDAFTARAN PENYEDIA JASA TRANS-CROP');
                $message->from('info@trans-crop.com','INFO PENDAFTARAN PENYEDIA JASA TRANS-CROP');
            });
            return $this->setJson("OK");
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_update);
        }
    }

    public function api_notifikasi_tolak(Request $request) {
        $where['id_cv'] = $request->id;
        $update['stt_cv'] = "DITOLAK";
        $update['stt_ulasan'] = $request->stt_ulasan;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbCVModel::where($where)->update($update);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/notifikasi'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_update);
        }
    }

    public function api_jenis_kendaraan_add(Request $request) {
        $insert['jenis_kendaraan'] = $request->jenis_kendaraan;
        $stmt = TbJenisKendaraanModel::insert($insert);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_kendaraan'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_jenis_kendaraan_update(Request $request) {
        $where['id_jenis_kendaraan'] = $request->id;
        $update['jenis_kendaraan'] = $request->jenis_kendaraan;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbJenisKendaraanModel::where($where)->update($update);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_kendaraan'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_update);
        }
    }

    public function api_jenis_sim_add(Request $request) {
        $insert['nama_sim'] = $request->nama_sim;
        $insert['keterangan'] = $request->keterangan;
        $stmt = TbSimModel::insert($insert);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_sim'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_jenis_sim_update(Request $request) {
        $where['id_sim'] = $request->id;
        $update['nama_sim'] = $request->nama_sim;
        $update['keterangan'] = $request->keterangan;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbSimModel::where($where)->update($update);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_sim'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_update);
        }
    }

    public function api_jenis_barang_add(Request $request) {
        $insert['jenis_barang'] = $request->jenis_barang;
        $stmt = TbJenisBarangModel::insert($insert);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_barang'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_jenis_barang_update(Request $request) {
        $where['id_jenis_barang'] = $request->id;
        $update['jenis_barang'] = $request->jenis_barang;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbJenisBarangModel::where($where)->update($update);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/jenis_barang'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_update);
        }
    }

    public function api_bank_add(Request $request) {
        $image = $request->file('foto_bank');
        $file_name = date('YmdHis').'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/upload/bank');
        $img = Image::make($image->getRealPath());
        $img->resize(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file_name);

        $insert['foto_bank'] = $file_name;
        $insert['nama_bank'] = $request->nama_bank;
        $insert['an_bank'] = $request->an_bank;
        $insert['norek_bank'] = $request->norek_bank;
        $stmt = TbBankModel::insert($insert);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/bank'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_bank_update(Request $request) {
        $image = $request->file('foto_bank');
        if (!empty($image)) {
            $file_name = date('YmdHis').'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/upload/bank');
            $img = Image::make($image->getRealPath());
            $img->resize(720, 720, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$file_name);
            $update['foto_bank'] = $file_name;
        }
        $where['id_bank'] = $request->id;
        $update['nama_bank'] = $request->nama_bank;
        $update['an_bank'] = $request->an_bank;
        $update['norek_bank'] = $request->norek_bank;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbBankModel::where($where)->update($update);
        if ($stmt) {
            if (!empty($image)){
                File::delete(public_path("/upload/bank/".$request->foto_bank_lama));
            }
            return $this->setJson("OK",url('/admin/bank'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_pengaturan_update(Request $request) {
        $where['id_pengaturan'] = $request->id;
        $update['deskripsi'] = $request->deskripsi;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbPengaturanModel::where($where)->update($update);
        if ($stmt) {
            return $this->setJson("OK",url('/admin/pengaturan'));
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_akun_update(Request $request) {
        $where['id_admin'] = 1;
        $update['username'] = $request->username;
        $update['updated_at'] = Helpers::getDateNow();
        $stmt = TbAdminModel::where($where)->update($update);
        if ($stmt) {
            $session['username'] = $request->username;
            Session::put($session);
            return $this->setJson("OK");
        } else {
            return $this->setJson("ERROR",null,$this->message_failed_save);
        }
    }

    public function api_password_update(Request $request) {
        $where['id_admin'] = 1;
        $stmt = TbAdminModel::where($where);
        if ($stmt) {
            $dt = $stmt->first();
            $password_ulangi = $request->password_ulangi;
            if ($dt->password == md5($password_ulangi)) {
                $update['password'] = md5($password_ulangi);
                $update['updated_at'] = Helpers::getDateNow();
                $stmt = TbAdminModel::where($where)->update($update);
                if ($stmt) {
                    return $this->setJson("OK");
                } else {
                    return $this->setJson("ERROR",null,$this->message_failed_update);
                }
            } else {
                return $this->setJson("ERROR",null,"Password lama salah...");
            }
        } else {
            return $this->setJson("ERROR",null,"Terjadi Kesalahan. Silahkan coba beberapa saat lagi...");
        }
    }

    public function tbl_laporan_pemesanan(Request $request) {
        if ($request->ajax()) {
            $data =  TbPemesananModel::select('tb_user.stt_login','tb_user.nama_user','tb_user.foto_user','tb_pemesanan.*')
                ->join('tb_user','tb_user.id_user','=','tb_pemesanan.id_user')
                ->where(array('tb_pemesanan.del_flage'=>0));
            if (!empty($request->tgl_dari)) {
                $data->whereBetween('tb_pemesanan.created_at', [$request->tgl_dari, $request->tgl_sampai]);
            }
            $data->latest('tb_pemesanan.id_pemesanan');
            return Datatables::of($data->get())->addIndexColumn()->make(true);
        }
    }

    public function api_grafik_pemesanan_bulan(Request $request){
        $stmt = TbPemesananModel::selectRaw('count(id_pemesanan) as total, day(created_at) as day, month(created_at) as bulan, year(created_at) as tahun')
            ->where(array('stt_pemesanan'=>"SELESAI",'del_flage'=>0))
            ->whereYear('created_at',date('Y'))
            ->whereMonth('created_at',$request->bulan)
            ->groupBy(array('day','bulan','tahun'));
        if ($stmt) {
            return $this->setJson("OK",$stmt->get());
        } else {
            return $this->setJson("ERROR",null,"Terjadi Kesalahan. Silahkan coba beberapa saat lagi...");
        }
    }

    public function api_grafik_pemesanan_tahun(Request $request) {
        $stmt = TbCVModel::selectRaw("nama_cv, id_cv as id_cv_cv, (SELECT COUNT(id_pemesanan) FROM tb_pemesanan WHERE id_cv = id_cv_cv AND stt_pemesanan = 'SELESAI' AND del_flage = 0 AND year(created_at) = ".$request->tahun.") as total")
            ->where(array('stt_cv'=>"DITERIMA",'del_flage'=>0));
        if ($stmt) {
            return $this->setJson("OK",$stmt->get());
        } else {
            return $this->setJson("ERROR",null,"Terjadi Kesalahan. Silahkan coba beberapa saat lagi...");
        }
    }



    public function api_delete(Request $request) {
        $type = $request->type;
        $id = $request->id;

        $update['del_flage'] = 1;
        $update['deleted_at'] = date('Y-m-d H:i:s');
        if ($type=="jenis_kendaraan") {
            $where['id_jenis_kendaraan'] = $id;
            $stmt = TbJenisKendaraanModel::where($where)->update($update);
        } elseif ($type=="jenis_barang") {
            $where['id_jenis_barang'] = $id;
            $stmt = TbJenisBarangModel::where($where)->update($update);
        } elseif ($type=="jenis_sim") {
            $where['id_sim'] = $id;
            $stmt = TbSimModel::where($where)->update($update);
        } elseif ($type=="bank") {
            $where['id_bank'] = $id;
            $stmt = TbBankModel::where($where)->update($update);
        } elseif ($type=="pemesanan") {
            $where['id_pemesanan'] = $id;
            $stmt = TbPemesananModel::where($where)->update($update);
        } elseif ($type=="perusahaan") {
            $where['id_cv'] = $id;
            $stmt = TbCVModel::where($where)->update($update);
        } elseif ($type=="sopir") {
            $where['id_sopir'] = $id;
            $stmt = TbSopirModel::where($where)->update($update);
        } elseif ($type=="pengguna") {
            $where['id_user'] = $id;
            $stmt = TbUserModel::where($where)->update($update);
        } elseif ($type=="kritik_saran") {
            $where['id_kritiksaran'] = $id;
            $stmt = TbKritikSaranModel::where($where)->update($update);
        }
        if ($stmt) {
            return $this->setJson("OK");
        } else {
            return $this->setJson("ERROR",null,"Gagal Menghapus Data...");
        }
    }

    private function setJson($status,$response=NULL,$message=NULL) {
        $data['status'] = $status;
        $data['data'] = $response;
        $data['message'] = $message;
        return response()->json($data);
    }
}
