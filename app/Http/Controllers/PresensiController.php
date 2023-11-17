<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Models\barcode;
use App\Models\mataPelajaran;
use App\Models\presensi;
use App\Models\User;
use Illuminate\Http\Request;
// use Twilio\Rest\Client;
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
        $id = "4940";
        $key = "088551370db812bfb19d0e9d18c9cb5d7b7b4869";
         $data = [
                'to' => $nomorBaru,
                'msg' => "Pada hari senin tanggal $d , {$user['nama_lengkap']} hadir pada pelajaran {$mapel['mata_pelajaran']}",
            ];

            $url = "https://onyxberry.com/services/wapi/Client/sendMessage";
            $url = $url . '/' . $id . '/' . $key;
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
           
            curl_close($ch);
            // // Menggunakan Guzzle untuk menjalankan URL
            $client = new Client();
            $res = $client->get($url);



            
        // //  Mengambil parameter 'target' dan 'token' dari URL
        // $target = $user['no_telepon_ortu'];
        // $message = urlencode("Pada hari senin tanggal $d , {$user['nama_lengkap']} hadir pada pelajaran {$mapel['mata_pelajaran']}");

        // //     // URL yang akan Anda jalankan secara otomatis
        // $url = 'https://api.fonnte.com/send/?target=' . $target . '&token=' . $token . '&message=' . $message;

        // // // Menggunakan Guzzle untuk menjalankan URL
        // $client = new Client();
        // $response = $client->get($url);
        // send wharsaap

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://api.fonnte.com/send',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => '',
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => 'POST',
        // CURLOPT_POSTFIELDS => array(
        // 'target' => $user['no_telepon_ortu'],
        // 'message' => "Pada hasi senin tanggal $d , {$user['nama_lengkap']} hadir pada pelajaran {$mapel['mata_pelajaran']}", 
        // 'countryCode' => '62', //optional
        // ),
        // CURLOPT_HTTPHEADER => array(
        //     "Authorization: $token" //change TOKEN to your actual token
        // ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;

        // $sid    = "AC07cbe8f29939296293c237a045050c14";
        // $token  = "9dd47b7d0e5f901bf1703b0b473e9e0d";
        // $twilio = new Client($sid, $token);
    
        // $nomorLama = $user['no_telepon_ortu'];

        // // Hapus karakter '-' atau spasi jika ada
        // $nomorLama = str_replace(['-', ' '], '', $nomorLama);

        // // Periksa apakah nomor dimulai dengan "0", jika iya, ganti dengan "+62"
        // if (substr($nomorLama, 0, 1) === '0') {
        //     $nomorLama = "+62" . substr($nomorLama, 1);
        // }

        // // Hasilnya akan menjadi "+6287722430557"
        // $nomorBaru = $nomorLama;

        // $message = $twilio->messages
        //   ->create("whatsapp:+6287722430557", // to
        //     array(
        //       "from" => "whatsapp:+14155238886",
        //       "body" => "Pada hasi senin tanggal $d , {$user['nama_lengkap']} hadir pada pelajaran {$mapel['mata_pelajaran']}"
        //     )
        //   );
        
        $bar = presensi::create($datas);
            
         return response([
             'presensi' => $bar,
             'user' => $user,
             'guru' => $guru,
             'response' =>  $res->getBody()->getContents(),
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
