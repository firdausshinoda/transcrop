<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\TbBankModel;
use App\Models\TbChatModel;
use App\Models\TbCVModel;
use App\Models\TbCVUlasanModel;
use App\Models\TbJenisKendaraanModel;
use App\Models\TbKendaraanModel;
use App\Models\TbKendaraanUlasanModel;
use App\Models\TbPemesananModel;
use App\Models\TbPemesananSopirModel;
use App\Models\TbSimModel;
use App\Models\TbSopirModel;
use App\Models\TbUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class ApiController extends Controller
{
    var $message_failed_get_data = "Gagal mengambil data. Silahkan coba lagi...";

    public function updateToken(Request $request) {
        $where['id_user'] = $request->id_user;
        $update['token_firebase'] = $request->token;
        $stmt = TbUserModel::where($where)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        }
    }
    public function register(Request $request) {
        $where['email_user'] = $request->email_user;
        $where['del_flage'] = 0;
        $cek = TbUserModel::where($where);
        if ($cek) {
            if ($cek->count() > 0) {
                return response()->json(['status' => 'ERROR','message'=>"E-mail telah terdaftar"]);
            } else {
                $insert['nama_user'] = $request->nama_user;
                $insert['email_user'] = $request->email_user;
                $insert['jenis_kelamin'] = $request->jenis_kelamin;
                $insert['password'] = md5($request->password);
                $insert['alamat_user'] = $request->alamat_user;
                $insert['created_at'] = date('Y-m-d H:i:s');
                if (TbUserModel::insert($insert)) {
                    return response()->json(['status' => 'OK']);
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"Pendaftaran Gagal. Silahkan coba lagi..."]);
                }
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function login(Request $request) {
        $where['email_user'] = $request->email_user;
        $stmt = TbUserModel::where($where);
        if ($stmt){
            if ($stmt->count() > 0 ) {
                $where2['email_user'] = $request->email_user;
                $where2['password'] = md5($request->password);
                $stmt2 = TbUserModel::where($where2);
                if ($stmt2) {
                    if ($stmt2->count() > 0) {
                        $dtUser = $stmt2->first();
                        TbUserModel::where('id_user',$dtUser->id_user)->update(array('token_firebase'=>$request->token));
                        $stmt2 = TbUserModel::where($where2);
                        $dtUser = $stmt2->first();
                        return response()->json(['status' => 'OK','data'=>$dtUser]);
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"E-mail & Password tidak terdaftar..."]);
                    }
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"E-mail tidak terdaftar..."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function login_sosmed(Request $request) {
        $nama = $request->nama;
        $email = $request->email;
        $foto = $request->foto;
        $id_sosmed = $request->id_sosmed;
        $jns_sosmed = $request->jns_sosmed;
        $ckSosmed = TbUserModel::where(array('email_user'=>$email));
        if ($ckSosmed->count() > 0) {
            $dtUser = $ckSosmed->first();
            if ($jns_sosmed=='GOOGLE') {
                $update['id_google'] = $id_sosmed;
            } else if ($jns_sosmed=='Facebook') {
                $update['id_fb'] = $id_sosmed;
            }
            $update['nama_user'] = $nama;
            $update['email_user'] = $email;
            $update['foto_user'] = $foto;
            $update['stt_login'] = $jns_sosmed;
            $update['token_firebase'] = $request->token;
            TbUserModel::where('id_user',$dtUser->id_user)->update($update);
            return response()->json(['status' => 'OK','data'=>$dtUser]);
        } else {
            if ($jns_sosmed=='GOOGLE') {
                $insert['id_google'] = $id_sosmed;
            } else if ($jns_sosmed=='Facebook') {
                $insert['id_fb'] = $id_sosmed;
            }
            $insert['kd_user'] = "AC".Helpers::generateKd();
            $insert['nama_user'] = $nama;
            $insert['email_user'] = $email;
            $insert['foto_user'] = $foto;
            $insert['stt_login'] = $jns_sosmed;
            $insert['token_firebase'] = $request->token;
            $stmt = TbUserModel::insert($insert);
            if ($stmt) {
                $getDetail = TbUserModel::where(array('email_user'=>$email));
                if ($getDetail->count() > 0) {
                    return response()->json(['status' => 'OK','data'=>$getDetail->first()]);
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"E-mail tidak terdaftar..."]);
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
            }
        }
    }

    public function kendaraanGet(){
        $where['tb_kendaraan.del_flage'] = 0;
        $where['tb_cv.stt_cv'] = "DITERIMA";
        $where['tb_cv.del_flage'] = 0;
        $stmt = TbKendaraanModel::select('tb_kendaraan.*','tb_cv.nama_cv','tb_cv.alamat_cv')
            ->join('tb_cv','tb_cv.id_cv','=','tb_kendaraan.id_cv')
            ->where($where)->latest('id_kendaraan');
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function kendaraanCari(Request $request){
        $search = $request->cari;
        $where['tb_kendaraan.del_flage'] = 0;
        $where['tb_cv.stt_cv'] = "DITERIMA";
        $where['tb_cv.del_flage'] = 0;
        $stmt = TbKendaraanModel::select('tb_kendaraan.*','tb_cv.nama_cv','tb_cv.alamat_cv')
            ->join('tb_cv','tb_cv.id_cv','=','tb_kendaraan.id_cv')
            ->where($where)
            ->where(function ($query) use ($search){
                if (!empty($search)) {
                    $query->where('tb_kendaraan.nama_kendaraan','LIKE',"%".strtolower($search)."%")
                        ->orWhere('tb_cv.nama_cv','LIKE',"%".strtolower($search)."%")
                        ->orWhere('tb_cv.alamat_cv','LIKE',"%".strtolower($search)."%");
                }
            })
            ->latest('id_kendaraan');
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function kendaraanDetail(Request $request){
        $id_kendaraan = $request->id_kendaraan;
        $stmt = TbKendaraanModel::select('tb_kendaraan.*','tb_cv.nama_cv','tb_cv.alamat_cv','tb_cv.id_user','tb_jenis_kendaraan.jenis_kendaraan',
                'tb_user.foto_user','tb_user.nama_user','tb_user.id_google','tb_user.id_fb')
            ->join('tb_cv','tb_cv.id_cv','=','tb_kendaraan.id_cv')
            ->join('tb_jenis_kendaraan','tb_jenis_kendaraan.id_jenis_kendaraan','=','tb_kendaraan.id_jenis_kendaraan')
            ->join('tb_user','tb_user.id_user','=','tb_cv.id_user')
            ->where('tb_kendaraan.id_kendaraan',$id_kendaraan);
        $stmt2 = TbKendaraanUlasanModel::select('tb_kendaraan_ulasan.*','tb_user.nama_user','tb_user.foto_user','tb_user.stt_login')
            ->join('tb_user','tb_user.id_user','=','tb_kendaraan_ulasan.id_user')
            ->where('tb_kendaraan_ulasan.id_kendaraan',$id_kendaraan)
            ->latest('tb_kendaraan_ulasan.id_kendaraan_ulasan');
        if ($stmt && $stmt2) {
            return response()->json(['status' => 'OK','data_kendaraan'=>$stmt->get(),'data_ulasan'=>$stmt2->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cvGet(){
        $where['del_flage'] = 0;
        $where['stt_cv'] = "DITERIMA";
        $stmt = TbCVModel::where($where)->latest('id_cv');
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cvDetail(Request $request){
        $id_cv = $request->id_cv;
        $stmt = TbCVModel::where('id_cv',$id_cv);
        $stmt2 = TbKendaraanModel::where(array('id_cv'=>$id_cv,'del_flage'=>0))->latest('id_kendaraan');
        $stmt3 = TbCVUlasanModel::select('tb_cv_ulasan.*','tb_user.nama_user','tb_user.foto_user','tb_user.stt_login')
            ->join('tb_user','tb_user.id_user','=','tb_cv_ulasan.id_user')->where(array('tb_cv_ulasan.id_cv'=>$id_cv,'tb_cv_ulasan.del_flage'=>1))
            ->latest('tb_cv_ulasan.id_cv_ulasan');
        if ($stmt && $stmt2 && $stmt3) {
            return response()->json(['status' => 'OK','data_cv'=>$stmt->get(),'data_kendaraan'=>$stmt2->get(),'data_ulasan'=>$stmt3->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function chatGet(Request $request) {
        $id_google = ""; $id_fb = "";
        $foto_user = ""; $nama_user = "";
        $isi = ""; $id_user_now = $request->id_user;
        $id_receiver = ""; $send_by_id = ""; $cdate = "";
        $stt_login_receiver = "";

        $data = array();
        $where['id_user_send'] = $orWhere['id_user_receiver'] = $id_user_now;
        $where['del_flage'] = 0;
        $stmt = TbChatModel::where($where)
            ->orWhere($orWhere)
            ->groupBy('kd_chat')
            ->latest('created_at');
        if ($stmt) {
            foreach ($stmt->get() as $a) {
                if ($id_user_now == $a->id_user_send) {
                    foreach (TbUserModel::where('id_user',$a->id_user_receiver)->get() as $b) {
                        $id_google = $b->id_google;
                        $id_fb = $b->id_fb;
                        $foto_user = $b->foto_user;
                        $nama_user = $b->nama_user;
                        $stt_login_receiver = $b->stt_login;
                    }
                }
                if ($id_user_now == $a->id_user_receiver) {
                    foreach (TbUserModel::where('id_user',$a->id_user_send)->get() as $b) {
                        $id_google = $b->id_google;
                        $id_fb = $b->id_fb;
                        $foto_user = $b->foto_user;
                        $nama_user = $b->nama_user;
                        $stt_login_receiver = $b->stt_login;
                    }
                }
                foreach (TbChatModel::where('kd_chat',$a->kd_chat)->offset(0)->limit(1)->latest('id_chat')->get() as $c) {
                    $isi = $c->isi;
                    $cdate = $c->created_at;
                }
                if ($id_user_now == $a->id_user_send) {
                    $id_receiver = $a->id_user_receiver;
                }
                if ($id_user_now == $a->id_user_receiver) {
                    $id_receiver = $a->id_user_send;
                }
                array_push($data,array('id_chat'=>$a->id_chat, 'kd_chat'=>$a->kd_chat, 'isi'=>$isi,
                    'created_at'=>$cdate, 'nama_user'=>$nama_user, 'foto_user'=>$foto_user, 'id_google'=>$id_google,
                    'id_fb'=>$id_fb, 'id_user'=>$id_receiver, 'stt_login_receiver'=>$stt_login_receiver));
            }
            return response()->json(['status' => 'OK','data'=>$data]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function chatRoomGet(Request $request) {
        $result = array();
        $id_user = $request->id_user;
        $id_contact = $request->id_contact;

        $stmt = DB::table('tb_chat')
            ->whereRaw("id_user_send = $id_user AND id_user_receiver = $id_contact  OR id_user_send = $id_contact AND id_user_receiver = $id_user")
            ->orderBy('id_chat','ASC');
        if ($stmt->count() > 0) {
            foreach ($stmt->get() as $item) {
                if ($id_user == $item->id_user_send) {
                    array_push($result,array('id_user_send'=>$item->id_user_send,"id_user_receiver"=>$item->id_user_receiver,'isi'=>$item->isi,
                        'send_by_id'=>$item->send_by_id,'created_at'=>$item->created_at,'kd_chat'=>$item->kd_chat,
                        'nama_kendaraan'=>$item->nama_kendaraan,'foto_kendaraan'=>$item->foto_kendaraan));
                }
                if ($id_user == $item->id_user_receiver) {
                    array_push($result,array('id_user_send'=>$item->id_user_send,"id_user_receiver"=>$item->id_user_receiver,'isi'=>$item->isi,
                        'send_by_id'=>$item->send_by_id,'created_at'=>$item->created_at,'kd_chat'=>$item->kd_chat,
                        'nama_kendaraan'=>$item->nama_kendaraan,'foto_kendaraan'=>$item->foto_kendaraan));
                }
            }
        }
        return response()->json(['status'=>"OK",'data'=>$result]);
    }

    public function chatRoomSend(Request $request) {
        $insert['id_user_send'] = $request->id_user_send;
        $insert['id_user_receiver'] = $request->id_user_receiver;
        $insert['isi'] = $request->isi;
        $insert['kd_chat'] = $request->kd_chat;
        $insert['nama_kendaraan'] = $request->nama_kendaraan;
        $insert['foto_kendaraan'] = $request->foto_kendaraan;
        $insert['send_by_id'] = $request->send_by_id;
        $insert['created_at'] = date('Y-m-d H:i:s');
        $stmt = TbChatModel::insert($insert);
        if ($stmt) {
            $id_user = 0;
            $id_user_receiver = 0;
            if ($request->send_by_id == $request->id_user_send) {
                $id_user = $request->id_user_receiver;
                $id_user_receiver = $request->id_user_send;
            } else {
                $id_user = $request->id_user_send;
                $id_user_receiver = $request->id_user_receiver;
            }
            $dt_pg = TbUserModel::where('id_user',$id_user)->first();
            $dt_pg_rec = TbUserModel::where('id_user',$id_user_receiver)->first();
            $token = array();
            array_push($token,$dt_pg->token_firebase);
            $apiKey = "AAAAuyRLr8s:APA91bHGSHbjB81hqYNbGU3QtYcAOF1KAZAVU2xZ4K59hu-bA_A10LOBijbkh7iX7-St9YxrQ1AypteyVDci1tV_lMKzZIvnJTu8hg1WGa5XoyLhzdB3_wl7tOesxC1Mtr0dOxSjeyai";
            $fields = array(
                'registration_ids'=>$token,
                'data' => array(
                    'TYPE'=>"CHAT",
                    'MESSAGE'=>$request->isi,
                    'ID_USER'=>$dt_pg_rec->id_user,
                    'NAMA_USER'=>$dt_pg_rec->nama_user,
                    'CDATE'=>date('Y-m-d H:i:s'),
                    'priority' => "high"
                )
            );
            $header = array('Authorization:key='.$apiKey,'Content-Type:application/json');
            $url = "https://fcm.googleapis.com/fcm/send";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
            $response = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengirim pesan silahkan coba lagi..."]);
        }
    }

    public function supirDetail(Request $request) {
        $where['tb_sopir.id_sopir'] = $request->id_sopir;
        $where['tb_sopir.del_flage'] = 0;
        $stmt = TbSopirModel::select('tb_sopir.created_at','tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_user.stt_login','tb_user.id_user','tb_user.nama_user','tb_user.nama_user','tb_user.foto_user','tb_user.alamat_user')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')->where($where);
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function bankGet(){
        $where['del_flage'] = 0;
        $stmt = TbBankModel::where($where)->latest('id_bank');
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function pemesananInsert(Request $request){
        $insert['kd_pemesanan'] = Helpers::getKodeRandom("PS");
        $insert['id_user'] = $request->id_user;
        $insert['id_cv'] = $request->id_cv;
        $insert['id_kendaraan'] = $request->id_kendaraan;
        $insert['alamat_berangkat'] = $request->alamat_berangkat;
        $insert['deskripsi_berangkat'] = $request->deskripsi_berangkat;
        $insert['lt_berangkat'] = $request->lt_berangkat;
        $insert['lg_berangkat'] = $request->lg_berangkat;
        $insert['alamat_tujuan'] = $request->alamat_tujuan;
        $insert['deskripsi_tujuan'] = $request->deskripsi_tujuan;
        $insert['lt_tujuan'] = $request->lt_tujuan;
        $insert['lg_tujuan'] = $request->lg_tujuan;
        $insert['deskripsi_barang'] = $request->deskripsi_barang;
        $insert['total_kendaraan'] = $request->total_kendaraan;
        $insert['jarak'] = $request->jarak;
        $insert['harga'] = $request->harga;
        $insert['id_bank'] = $request->id_bank;
        $insert['time_from'] = $request->time_from;
        $insert['date_from'] = $request->date_from;
        $insert['berat_barang'] = $request->berat_barang;
        $insert['avoid'] = $request->avoid;
        $insert['harga_tol'] = $request->harga_tol;
        $insert['harga_total'] = $request->harga_total;
        $stmt = TbPemesananModel::insert($insert);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal melakukan pemesanan. Silahkan coba lagi.."]);
        }
    }

    public function pemesananGet(Request $request) {
        $stt = $request->stt_pemesanan;
        $where['tb_pemesanan.id_user'] = $request->id_user;
        $where['tb_pemesanan.del_flage'] = 0;
        $stmt = TbPemesananModel::select('tb_pemesanan.*','tb_kendaraan.foto_kendaraan')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->where($where);
        if ($stt=="MENUNGGU") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["MENUNGGU","MENUNGGU KONFIRMASI PEMESAN"]);
        } else if ($stt=="BATAL") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["DIBATALKAN","DITOLAK"]);
        } else if ($stt=="SELESAI") {
            $stmt->where('tb_pemesanan.stt_pemesanan',"SELESAI");
        } else if ($stt=="SETUJU") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["TERKONFIRMASI","MENUNGGU KONFIRMASI PEMBAYARAN","PEMBAYARAN TERKONFIRMASI","DIANTARKAN"]);
        }
        $stmt->latest('tb_pemesanan.id_pemesanan');
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function pemesananDetail(Request $request) {
        $id_pemesanan = $request->id_pemesanan;
        $stmt = TbPemesananModel::selectRaw('tb_pemesanan.*, tb_kendaraan.nama_kendaraan, tb_kendaraan.foto_kendaraan, tb_bank.nama_bank, tb_bank.norek_bank, tb_cv.nama_cv,
            tb_cv_ulasan.ratting_ulasan as ratting_ulasan_cv, tb_cv_ulasan.isi_ulasan as isi_ulasan_cv,
            tb_kendaraan_ulasan.ratting_ulasan as ratting_ulasan_kendaraan, tb_kendaraan_ulasan.isi_ulasan as isi_ulasan_kendaraan')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->join('tb_bank','tb_bank.id_bank','=','tb_pemesanan.id_bank','LEFT')
            ->join('tb_cv','tb_cv.id_cv','=','tb_pemesanan.id_cv')
            ->join('tb_cv_ulasan','tb_cv_ulasan.id_pemesanan','=','tb_pemesanan.id_pemesanan','LEFT')
            ->join('tb_kendaraan_ulasan','tb_kendaraan_ulasan.id_pemesanan','=','tb_pemesanan.id_pemesanan','LEFT')
            ->where('tb_pemesanan.id_pemesanan',$id_pemesanan);
        $stmt2 = TbPemesananSopirModel::select('tb_pemesanan_sopir.created_at','tb_user.stt_login','tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_user.id_user','tb_user.nama_user','tb_user.nama_user','tb_user.foto_user','tb_user.alamat_user')
            ->join('tb_sopir','tb_sopir.id_sopir','=','tb_pemesanan_sopir.id_sopir')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where('tb_pemesanan_sopir.id_pemesanan',$id_pemesanan);
        if ($stmt && $stmt2) {
            return response()->json(['status' => 'OK', 'data_pemesanan' => $stmt->get(), 'data_sopir' => $stmt2->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function pemesananKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "TERKONFIRMASI";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function pemesananPembayaran(Request $request) {
        $image = $request->file('foto');
        $file_name = date('YmdHis').'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/upload/pembayaran');
        $img = Image::make($image->getRealPath());
        $img->resize(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$file_name);

        $update['foto_pembayaran'] = $file_name;
        $update['stt_pemesanan'] = "MENUNGGU KONFIRMASI PEMBAYARAN";
        $update['updated_at'] = date('Y-m-d H:i:s');
        if (TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update)) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal Mengunggah Bukti Pembayaran. Silahkan Coba Lagi!!!"]);
        }
    }

    public function pemesananUlasan(Request $request) {
        $id_pemesanan = $request->id_pemesanan;
        $id_user = $request->id_user;

        $update_pemesanan['ratting_ulasan'] = $request->rating_pemesanan;
        $update_pemesanan['isi_ulasan'] = $request->ulasan_pemesanan;
        $stmt1 = TbPemesananModel::where('id_pemesanan',$id_pemesanan)->update($update_pemesanan);

        $insert_cv['id_pemesanan'] = $id_pemesanan;
        $insert_cv['id_user'] = $id_user;
        $insert_cv['id_cv'] = $request->id_cv;
        $insert_cv['ratting_ulasan'] = $request->rating_cv;
        $insert_cv['isi_ulasan'] = $request->ulasan_cv;
        $stmt2 = TbCVUlasanModel::insert($insert_cv);

        $insert_kendaraan['id_pemesanan'] = $id_pemesanan;
        $insert_kendaraan['id_user'] = $id_user;
        $insert_kendaraan['id_kendaraan'] = $request->id_kendaraan;
        $insert_kendaraan['ratting_ulasan'] = $request->rating_kendaraan;
        $insert_kendaraan['isi_ulasan'] = $request->ulasan_kendaraan;
        $stmt3 = TbKendaraanUlasanModel::insert($insert_kendaraan);

        if ($stmt1 && $stmt2 && $stmt3) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal Menyimpan Ulasan. Silahkan Coba Lagi!!!"]);
        }
    }

    public function updateAkun(Request $request) {
        $where['id_user'] = $request->id_user;
        $update['nama_user'] = $request->nama_user;
        $update['email_user'] = $request->email_user;
        $update['jenis_kelamin'] = $request->jenis_kelamin;
        $update['alamat_user'] = $request->alamat_user;
        $update['nik'] = $request->nik;
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbUserModel::where($where)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengubah data. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function updatePassword(Request $request) {
        $where['id_user'] = $request->id_user;
        $update['password'] = md5($request->password_ulangi);
        $update['updated_at'] = date('Y-m-d H:i:s');
        $password_lama = $request->password_lama;
        $ckUser = TbUserModel::where($where);
        if ($ckUser) {
            if ($ckUser->count() > 0) {
                $dt = $ckUser->first();
                if ($dt->password == md5($password_lama)) {
                    $stmt = TbUserModel::where($where)->update($update);
                    if ($stmt) {
                        return response()->json(['status' => 'OK']);
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"Gagal mengubah data. Silahkan coba lagi beberapa saat..."]);
                    }
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"Password lama tidak sama."]);
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Pengguna tidak ditemukan."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengecek data. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function updateFoto(Request $request) {

    }

    public function cv_login(Request $request) {
        $where['kd_cv'] = $request->kd_cv;
        $stmt = TbCVModel::where($where);
        if ($stmt){
            if ($stmt->count() > 0 ) {
                $where2['kd_cv'] = $request->kd_cv;
                $where2['password'] = md5($request->password);
                $stmt2 = TbCVModel::where($where2);
                if ($stmt2) {
                    if ($stmt2->count() > 0) {
                        $dt = $stmt2->first();
                        if ($dt->stt_cv == "DITERIMA") {
                            return response()->json(['status' => 'OK','data'=>$dt]);
                        } else {
                            return response()->json(['status' => 'ERROR','message'=>"Akun penyedia jasa anda berstatus ".$dt->stt_cv]);
                        }
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"Kode Penyedia Jasa & Password tidak terdaftar..."]);
                    }
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Kode Penyedia Jasa tidak terdaftar..."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cv_pemesananGet(Request $request) {
        $stt = $request->stt_pemesanan;
        $where['tb_pemesanan.id_cv'] = $request->id_cv;
        $where['tb_pemesanan.del_flage'] = 0;
        $stmt = TbPemesananModel::select('tb_pemesanan.*','tb_kendaraan.foto_kendaraan')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->where($where);
        if ($stt=="MENUNGGU") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["MENUNGGU","MENUNGGU KONFIRMASI PEMESAN"]);
        } else if ($stt=="BATAL") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["DIBATALKAN","DITOLAK"]);
        } else if ($stt=="SELESAI") {
            $stmt->where('tb_pemesanan.stt_pemesanan', "SELESAI");
        } else if ($stt=="SETUJU") {
            $stmt->whereIn('tb_pemesanan.stt_pemesanan', ["TERKONFIRMASI","MENUNGGU KONFIRMASI PEMBAYARAN","PEMBAYARAN TERKONFIRMASI","DIANTARKAN"]);
        }
        $stmt->latest('tb_pemesanan.id_pemesanan');
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cv_pemesananDetail(Request $request) {
        $id_pemesanan = $request->id_pemesanan;
        $stmt = TbPemesananModel::select('tb_pemesanan.*','tb_kendaraan.nama_kendaraan','tb_kendaraan.foto_kendaraan','tb_bank.nama_bank','tb_bank.norek_bank','tb_cv.nama_cv')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->join('tb_bank','tb_bank.id_bank','=','tb_pemesanan.id_bank','LEFT')
            ->join('tb_cv','tb_cv.id_cv','=','tb_pemesanan.id_cv')
            ->where('tb_pemesanan.id_pemesanan',$id_pemesanan);
        $stmt2 = TbPemesananSopirModel::select('tb_pemesanan_sopir.created_at','tb_sopir.id_sopir','tb_user.stt_login','tb_sopir.kd_sopir','tb_user.id_user','tb_user.nama_user','tb_user.nama_user','tb_user.foto_user','tb_user.alamat_user')
            ->join('tb_sopir','tb_sopir.id_sopir','=','tb_pemesanan_sopir.id_sopir')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where('tb_pemesanan_sopir.id_pemesanan',$id_pemesanan);
        if ($stmt && $stmt2) {
            return response()->json(['status' => 'OK', 'data_pemesanan' => $stmt->get(), 'data_sopir' => $stmt2->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cv_pemesananKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "TERKONFIRMASI";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_pemesananpembayaranKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "PEMBAYARAN TERKONFIRMASI";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_pemesananDiantarkanKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "DIANTARKAN";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_pemesananSupirInsert(Request $request) {
        $insert['id_pemesanan'] = $request->id_pemesanan;
        $insert['id_sopir'] = $request->id_sopir;
        $stmt = TbPemesananSopirModel::insert($insert);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal menambahkan supir. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_pemesananSupirChekInsert(Request $request) {
        $whereNotInt = TbPemesananSopirModel::select('id_sopir')->where('id_pemesanan',$request->id_pemesanan)->get()->toArray();

        $where['tb_sopir.id_cv'] = $request->id_cv;
        $where['tb_sopir.del_flage'] = 0;
        $stmt = TbSopirModel::select('tb_sopir.created_at','tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_user.stt_login','tb_user.id_user','tb_user.nama_user','tb_user.nama_user','tb_user.foto_user','tb_user.alamat_user')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->where($where)
            ->whereNotIn('tb_sopir.id_sopir', $whereNotInt);
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_sopirTambah(Request $request) {
        $update['id_cv'] = $request->id_cv;
        $where['kd_sopir'] = $request->kd_sopir;
        $stmt = TbSopirModel::where($where)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal menambahkan sopir. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_sopirDetail(Request $request) {
        $where['tb_sopir.kd_sopir'] = $request->kd_sopir;
        $where['tb_sopir.del_flage'] = 0;
        $stmt = TbSopirModel::select('tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_user.nama_user','tb_sim.nama_sim')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->join('tb_sim','tb_sim.id_sim','=','tb_sopir.id_sim')
            ->where($where);
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->first()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_sopirGet(Request $request) {
        $where['tb_sopir.id_cv'] = $request->id_cv;
        $where['tb_sopir.del_flage'] = 0;
        $stmt = TbSopirModel::select('tb_sopir.created_at','tb_sopir.id_sopir','tb_sopir.kd_sopir','tb_user.stt_login','tb_user.id_user','tb_user.nama_user','tb_user.nama_user','tb_user.foto_user','tb_user.alamat_user')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')->where($where);
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function cv_kendaraanGet(Request $request) {
        $where['tb_kendaraan.del_flage'] = 0;
        $where['tb_cv.id_cv'] = $request->id_cv;
        $stmt = TbKendaraanModel::select('tb_kendaraan.*','tb_cv.nama_cv','tb_cv.alamat_cv')
            ->join('tb_cv','tb_cv.id_cv','=','tb_kendaraan.id_cv')
            ->where($where)->latest('id_kendaraan');
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cv_detail(Request $request){
        $stmt = TbCVModel::select('tb_cv.*','tb_user.nama_user','tb_user.email_user','tb_user.foto_user','tb_user.stt_login')
            ->join('tb_user','tb_user.id_user','=','tb_cv.id_user')
            ->where('tb_cv.id_cv',$request->id_cv);
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function cv_updatePassword(Request $request) {
        $where['id_cv'] = $request->id_cv;
        $update['password'] = md5($request->password_ulangi);
        $update['updated_at'] = date('Y-m-d H:i:s');
        $password_lama = $request->password_lama;
        $ckUser = TbCVModel::where($where);
        if ($ckUser) {
            if ($ckUser->count() > 0) {
                $dt = $ckUser->first();
                if ($dt->password == md5($password_lama)) {
                    $stmt = TbCVModel::where($where)->update($update);
                    if ($stmt) {
                        return response()->json(['status' => 'OK']);
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"Gagal mengubah data. Silahkan coba lagi beberapa saat..."]);
                    }
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"Password lama tidak sama."]);
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Pengguna tidak ditemukan."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengecek data. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function sopir_register(Request $request) {
        $where['id_user'] = $request->id_user;
        $where['del_flage'] = 0;
        $stmt = TbSopirModel::where($where);
        if ($stmt){
            if ($stmt->count() == 0 ) {
                $insert['id_user'] = $request->id_user;
                $insert['id_sim'] = $request->id_sim;
                $insert['pengalaman'] = $request->pengalaman;
                $insert['kd_sopir'] = "TCD".Helpers::generateKd();
                $insert['created_at'] = date('Y-m-d H:i:s');
                $stmt2 = TbSopirModel::insert($insert);
                if ($stmt2) {
                    return response()->json(['status' => 'OK']);
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"Gagal melakukan pendaftaran. Silahkan coba lagi beberapa saat..."]);
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Akun anda telah digunakan untuk mendaftarkan diri sebagai SOPIR."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mendaftar. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function sopir_login(Request $request) {
        $where['kd_sopir'] = $request->kd_sopir;
        $where['del_flage'] = 0;
        $stmt = TbSopirModel::where($where);
        if ($stmt){
            if ($stmt->count() > 0 ) {
                $where2['tb_sopir.kd_sopir'] = $request->kd_sopir;
                $where2['tb_sopir.password'] = md5($request->password);
                $stmt2 = TbSopirModel::select('tb_sopir.*','tb_sim.nama_sim')
                    ->join('tb_sim','tb_sim.id_sim','=','tb_sopir.id_sim')
                    ->where($where2);
                if ($stmt2) {
                    if ($stmt2->count() > 0) {
                        return response()->json(['status' => 'OK','data'=>$stmt2->first()]);
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"Kode Sopir & Password tidak terdaftar..."]);
                    }
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Kode Sopir tidak terdaftar..."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function sopir_simGet(){
        $stmt = TbSimModel::where('del_flage','=',0);
        if ($stmt){
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function sopir_pemesananGet(Request $request) {
        $stt = $request->stt_pemesanan;
        $where['tb_pemesanan_sopir.id_sopir'] = $request->id_sopir;
        $where['tb_pemesanan.del_flage'] = 0;
        $stmt = TbPemesananSopirModel::select('tb_pemesanan.*','tb_kendaraan.foto_kendaraan')
            ->join('tb_pemesanan','tb_pemesanan.id_pemesanan','=','tb_pemesanan_sopir.id_pemesanan')
            ->join('tb_kendaraan','tb_kendaraan.id_kendaraan','=','tb_pemesanan.id_kendaraan')
            ->where($where);
        if ($stt=="MENUNGGU") {
            $stmt->where('tb_pemesanan.stt_pemesanan',"PEMBAYARAN TERKONFIRMASI");
        } else if ($stt=="DIANTARKAN") {
            $stmt->where('tb_pemesanan.stt_pemesanan',"DIANTARKAN");
        } else if ($stt=="SELESAI") {
            $stmt->where('tb_pemesanan.stt_pemesanan',"SELESAI");
        }
        $stmt->latest('tb_pemesanan.id_pemesanan');
        if ($stmt) {
            return response()->json(['status' => 'OK', 'data' => $stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function sopir_pemesananDiantarkanKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "DIANTARKAN";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function sopir_pemesananSelesaiKonfirmasi(Request $request) {
        $update['stt_pemesanan'] = "SELESAI";
        $update['updated_at'] = date('Y-m-d H:i:s');
        $stmt = TbPemesananModel::where('id_pemesanan',$request->id_pemesanan)->update($update);
        if ($stmt) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengkonfirmasi pemesanan. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function sopir_cvDetail(Request $request){
        $id_sopir = $request->id_sopir;
        $stmt = TbSopirModel::select('tb_cv.*','tb_user.nama_user','tb_user.email_user','tb_user.foto_user','tb_user.stt_login')
            ->join('tb_cv','tb_cv.id_cv','=','tb_sopir.id_cv')
            ->join('tb_user','tb_user.id_user','=','tb_cv.id_user')
            ->where(array('tb_sopir.id_sopir'=>$id_sopir,'tb_sopir.del_flage'=>0));
        $stmt2 = TbSopirModel::select('tb_kendaraan.*')->join('tb_cv','tb_cv.id_cv','=','tb_sopir.id_cv')
            ->join('tb_kendaraan','tb_kendaraan.id_cv','=','tb_cv.id_cv')
            ->where(array('tb_sopir.id_sopir'=>$id_sopir,'tb_kendaraan.del_flage'=>0))
            ->latest('tb_kendaraan.id_kendaraan');
        if ($stmt && $stmt2) {
            return response()->json(['status' => 'OK','data_cv'=>$stmt->get(),'data_kendaraan'=>$stmt2->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function sopir_detail(Request $request) {
        $stmt = TbSopirModel::select('tb_sopir.*','tb_user.nama_user','tb_user.email_user','tb_user.foto_user',
                'tb_user.stt_login','tb_sim.nama_sim')
            ->join('tb_user','tb_user.id_user','=','tb_sopir.id_user')
            ->join('tb_sim','tb_sim.id_sim','=','tb_sopir.id_sim')
            ->where('tb_sopir.id_sopir',$request->id_sopir);
        if ($stmt) {
            return response()->json(['status' => 'OK','data'=>$stmt->get()]);
        } else {
            return response()->json(['status' => 'ERROR','message'=>$this->message_failed_get_data]);
        }
    }

    public function sopir_akunUpdate(Request $request) {
        $where['id_sopir'] = $request->id_sopir;
        $update['id_sim'] = $request->id_sim;
        $update['pengalaman'] = $request->pengalaman;
        $update['updated_at'] = date('Y-m-d H:i:s');
        if (TbSopirModel::where($where)->update($update)) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengubah data..."]);
        }
    }

    public function sopir_updatePassword(Request $request) {
        $where['id_sopir'] = $request->id_sopir;
        $update['password'] = md5($request->password_ulangi);
        $update['updated_at'] = date('Y-m-d H:i:s');
        $password_lama = $request->password_lama;
        $ckUser = TbSopirModel::where($where);
        if ($ckUser) {
            if ($ckUser->count() > 0) {
                $dt = $ckUser->first();
                if ($dt->password == md5($password_lama)) {
                    $stmt = TbSopirModel::where($where)->update($update);
                    if ($stmt) {
                        return response()->json(['status' => 'OK']);
                    } else {
                        return response()->json(['status' => 'ERROR','message'=>"Gagal mengubah data. Silahkan coba lagi beberapa saat..."]);
                    }
                } else {
                    return response()->json(['status' => 'ERROR','message'=>"Password lama tidak sama."]);
                }
            } else {
                return response()->json(['status' => 'ERROR','message'=>"Pengguna tidak ditemukan."]);
            }
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal mengecek data. Silahkan coba lagi beberapa saat..."]);
        }
    }

    public function registerCV(Request $request) {
        $image_siup = $request->file('foto_siup');
        $image_skdp = $request->file('foto_siup');
        $file_name_siup = date('YmdHis').'.'.$image_siup->getClientOriginalExtension();
        $file_name_skdp = date('YmdHis').'.'.$image_skdp->getClientOriginalExtension();

        $destinationPath_siup = public_path('/upload/siup');
        $destinationPath_skdp = public_path('/upload/skdp');
        $img_siup = Image::make($image_siup->getRealPath());
        $img_skdp = Image::make($image_skdp->getRealPath());
        $img_siup->resize(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_siup.'/'.$file_name_siup);
        $img_skdp->resize(720, 720, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath_skdp.'/'.$file_name_skdp);

        $kd_tpj = "TPJ".Helpers::generateKd();
        $insert['siup'] = $file_name_siup;
        $insert['skdp'] = $file_name_skdp;
        $insert['kd_cv'] = $kd_tpj;
        $insert['id_user'] = $request->id_user;
        $insert['nama_cv'] = $request->nama_cv;
        $insert['deskripsi_cv'] = $request->deskripsi_cv;
        $insert['password'] = md5($request->password);
        $insert['alamat_cv'] = $request->alamat_cv;
        $insert['stt_cv'] = "MENUNGGU";
        $insert['created_at'] = date('Y-m-d H:i:s');
        if (TbCVModel::insert($insert)) {
            $to_body = "KD PJ anda adalah ".$kd_tpj." dan pendaftaran anda sedang kami cek kelengkapan data dan validitasnya. Akan kami infokan kembali melalui E-mail untuk hasil konfirmasinya.";
            $to_email = $request->email_user;
            $to_nama = $request->nama_user;
            $data = array('nama'=>$to_nama, "body" => $to_body);
            Mail::send('other.mail', $data, function($message) use ($to_nama, $to_email) {
                $message->to($to_email, $to_nama)
                    ->subject('INFO PENDAFTARAN PENYEDIA JASA TRANS-CROP');
                $message->from('info@trans-crop.com','INFO PENDAFTARAN PENYEDIA JASA TRANS-CROP');
            });
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'ERROR','message'=>"Gagal Mengunggah Bukti Pembayaran. Silahkan Coba Lagi!!!"]);
        }
    }
}
