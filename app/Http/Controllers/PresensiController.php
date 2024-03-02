<?php

namespace App\Http\Controllers;
use App\Models\barcode;
use App\Models\mataPelajaran;
use App\Models\presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
class PresensiController extends Controller
{
    
    public function index() {
        $presensi = presensi::all();
         return response([
             'presensi' => $presensi,
         ],200);
        }
        public function store($barccode, $nis) {
        // $token = "a9nG9DFEPAvW!Dt5pdjx";
        $user = User::whereNis($nis)->first();
        $guru = barcode::whereId($barccode)->first();
        $mapel = mataPelajaran::whereId($guru->mata_pelajaran_id)->first();
        $datas = [   
         'user_id' => $user['id'],
         'guru_id' => $guru['guru_id'],
         'barcode_id' => $barccode,
         'mata_pelajaran_id' => $mapel['id'],
        ];

        $d = date('d F Y');

         $nomorLama = $user['no_telepon_ortu'];

        // Hapus karakter '-' atau spasi jika ada
        $nomorLama = str_replace(['-', ' '], '', $nomorLama);

        // Periksa apakah nomor dimulai dengan "0", jika iya, ganti dengan "+62"
        if (substr($nomorLama, 0, 1) === '0') {
            $nomorLama = "+62" . substr($nomorLama, 1);
        }

        // Hasilnya akan menjadi "+6287722430557"
        $nomorBaru = $nomorLama;
        // $nomorBaru = $nomorLama;
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $twilio = new Client($sid, $token);
         $body = "Pada hari senin tanggal $d , {$user['nama_lengkap']} hadir pada pelajaran {$mapel['mata_pelajaran']}";
        $message = $twilio->messages
        ->create("whatsapp:$nomorBaru", // to
            array(
              "from" => "whatsapp:+14155238886",
              "body" => $body,
            )
          );
            
        // //  Mengambil parameter 'target' dan 'token' dari URL
        // $target = $user['no_telepon_ortu'];
       

     
        $bar = presensi::create($datas);
            
         return response([
             'presensi' => $bar,
             'user' => $user,
             'guru' => $guru,
             'respon' => $message->sid
         ],200);
        
        }
        public function show($id) {
         $presensi = presensi::whereId($id)->get();
         return response([
             'presensi' => $presensi,
         ],200);
        }
        public function update(Request $request, $id) {
        $presensi = presensi::find($id);
        if (!$presensi) {
            return response()->json(['message' => 'Post not found'], 404);
        }
         $presensi->update($request->all());
     
         return response()->json([
             'messahe' => 'Berhasil Update',
             'presensi' => $presensi,
         ]);
        }


        // get data by guru
        public function delete($id) {
         presensi::whereId($id)->delete();
         return response([
             'messahe' => 'Berhasil delete',
         ],200);
        }
      
}
