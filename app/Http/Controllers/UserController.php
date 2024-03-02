<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\barcode;
use App\Models\mataPelajaran;
use App\Models\presensi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function views() {
        
        $user = User::all();
        return view("admin.siswa.index", compact('user'));
    }
    public function index(){
        $user = User::orderBy('created_at', 'desc')->with('presensis')->get();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function bySiswa($nis){
        $user = User::whereNis($nis)->first();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function byPresnsi($nis){
        $d = date('Y-m-d');
        $user = User::where('nis', $nis)->first();
        $presence = Presensi::with('mata_pelajaran')
            ->where('user_id', $user->id)
            ->whereDate('created_at', $d) 
            ->latest()->get();

        return response()->json([
            'presence' => $presence,
        ]);
    }
    public function thisWeek($nis){
        $startDate = Carbon::now()->subWeek(); // Menghitung tanggal satu minggu yang lalu
        $endDate = Carbon::now(); // Menghitung tanggal saat ini
        $user = User::where('nis', $nis)->first();
        $presence = Presensi::with('mata_pelajaran')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])->latest()->get();

        return response()->json([
            'presence' => $presence,
        ]);
    }
    // public function store(Request $request) {
    //     $request->validate([
    //         'kode_guru' => 'required|max:10',
    //         'nip' => 'required',
    //         'nama_guru' => 'required',
    //         'no_whatsapp' => 'required|max:15',
    //         'alamat_lengkap' => 'required',
    //         'akun_id' => 'required',
    // ]);
    // $data = [
    //     'kode_guru' => $request->kode_guru,
    //     'nip' => $request->nip,
    //     'nama_guru' =>$request->nama_guru,
    //     'no_whatsapp' => $request->no_whatsapp,
    //     'alamat_lengkap' => $request->alamat_lengkap,
    //     'akun_id' =>$request->akun_id,
    // ];
    // $user = guru::create($data);

    //     return response([
    //         'user' => $user,
    //     ],200);
    // }
    public function updatePassword(Request $request ,$nis) {
        $user = User::where('nis',$nis)->update([
            'password' =>Hash::make($request->password),
        ]);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        // $user->update([
        //     'password' =>Hash::make($request->password),
        // ]);
        $akun = akun::whereNisp($nis)->update([
            'password' =>Hash::make($request->password),
        ]);
        if (!$akun) {
            return response()->json(['message' => 'akun not found'], 404);
        }
        // $akun->update([
        //     'password' =>Hash::make($request->password),
        // ]);
        return response([
            'user' => $user,
            'akun' => $akun,
        ],200);
    }
    public function show($id) {
        $guru = User::whereId($id)->get();

        return response([
            'guru' => $guru,
        ],200);
    }
    public function update(Request $request, $nis) {
        $user = User::where('nis', $nis)->first();
        
        // Memeriksa apakah user ditemukan
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Menggunakan metode fill() dan save() untuk mengupdate data user
        $user->fill($request->all());
        $user->save();
    
        return response()->json([
            'message' => 'success', // Memperbaiki typo pada 'message'
            'user' => $user,
        ]);
    }
    public function delete($nis) {
        $user = User::whereNis($nis); // Perbaikan: Gunakan 'whereNis' bukan 'fint'
        $akun = akun::whereNisp($nis); // Perbaikan: Gunakan 'find' bukan 'fint'
        
        if ($user) {
            $user->delete();
            $akun->delete();
            return response()->json([
                'message' => 'success',
            ]);
        } else {
            return response()->json([
                'message' => 'User not found',
            ], 404); // Berikan respons status 404 jika pengguna tidak ditemukan
        }
    }
    
}
