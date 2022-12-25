<?php

namespace App\Http\Controllers;

use App\Models\TbAdminModel;
use App\Models\TbPengaturanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function assetlinks() {
        $data['relation'] = "delegate_permission/common.handle_all_urls";
        $data['target']['namespace'] = "android_app";
        $data['target']['package_name'] = "com.firdaus.transcrop";
        $data['target']['sha256_cert_fingerprints'] = "23:BD:EC:E0:5C:14:CC:D3:E5:42:2B:A7:89:C9:4E:FF:E3:26:0E:9D:40:5C:CF:5E:F1:03:74:29:F7:AF:FC:4F";
        return response()->json($data);
    }
    public function index(){
        $data['penggunaan'] = TbPengaturanModel::where('id_pengaturan',3)->first()->deskripsi;
        $data['deskripsi'] = TbPengaturanModel::where('id_pengaturan',4)->first()->deskripsi;
        $data['tentang2'] = TbPengaturanModel::where('id_pengaturan',5)->first()->deskripsi;
        return view('dashboard.index',$data);
    }
    public function mitra(){
        $data['mitra'] = TbPengaturanModel::where('id_pengaturan',1)->first()->deskripsi;
        return view('dashboard.mitra',$data);
    }
    public function tentang(){
        $data['tentang'] = TbPengaturanModel::where('id_pengaturan',2)->first()->deskripsi;
        return view('dashboard.tentang',$data);
    }
    public function masuk(){
        return view('dashboard.masuk');
    }
    public function login_exe(Request $request) {
        $where['username'] = $request->username;
        $where['password'] = md5($request->password);
        $stmt = TbAdminModel::where($where);
        if ($stmt->count() > 0) {
            $dt = $stmt->first();
            $session['id_admnin'] = $dt->id_admnin;
            $session['username'] = $dt->username;
            $session['agrocar-admin'] = true;
            Session::put($session);
            return redirect(url('admin'));
        } else {
            return redirect(url('masuk'))->with('message','<div class="alert alert-danger" role="alert">Username atau password tidak ditemukan</div>');
        }
    }
}
