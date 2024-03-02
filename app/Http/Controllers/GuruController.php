<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
 
    public function views() {
        
        $guru = guru::all();
        return view("admin.guru.index", compact('guru'));
    }
   public function index() {
    $guru = guru::all();
     return response([
         'guru' => $guru,
     ],200);
    }
    public function store(Request $request) {
     $request->validate([
         'nip' => 'required',
         'nama_guru' => 'required',
         'no_whatsapp' => 'required|max:15',
         'alamat_lengkap' => 'required',
    ]);
    $akuns = akun::whereNisp($request->nip)->first();
    $akun = akun::create([
     'nisp' => $request->nip,
     'password' => Hash::make($request->password),
     'level' => 'guru',
    ]);
    $guru = guru::latest()->first();
    if ($guru == null) {
        // kode pertama
        $noUrut = "0001";
    }else{
        // kode selanjutnya
        $noUrut = substr($guru->kode_guru, 4,4)+1;
        $noUrut = str_pad($noUrut, 4 , "0", STR_PAD_LEFT);
    }
    $data = [
     'kode_guru' => 'GURU'.$noUrut,
     'nip' => $request->nip,
     'nama_guru' =>$request->nama_guru,
     'no_whatsapp' => $request->no_whatsapp,
     'alamat_lengkap' => $request->alamat_lengkap,
     'akun_id' => $akun->id,
     'level' => 'guru',
     'password' =>Hash::make($request->password),
    ];
    $guru = guru::create($data);
 
     return response([
         'guru' => $guru,
         'akun' => $akun,
         'message' => 'success',
     ],200);
    }
    public function show($id) {
     $guru = guru::whereId($id)->get();
     return response([
         'guru' => $guru,
     ],200);
    }
    public function showGuru($nip) {
     $guru = guru::whereNip($nip)->first();
     return response([
         'guru' => $guru,
         'message' => 'success',
     ],200);
    }
    public function update(Request $request, $nip) {

    $guru = guru::whereNip($nip)->first();
    if (!$guru) {
        return response()->json(['message' => 'Guru not found'], 404);
    }
    $akun = akun::whereNisp($nip)->first();
    $akun['nisp'] = $request->nip;
    $akun->update();
     $guru->update($request->all());
     return response()->json([
        'message' => 'success',
         'guru' => $guru,
     ]);
    }
    public function updatePassword(Request $request, $nip) {

    $akun = akun::whereNisp($nip)->first();
    $guru = guru::whereNip($nip)->first();
    if (!$guru) {
        return response()->json(['message' => 'Guru not found'], 404);
    }
    if (!$akun) {
        return response()->json(['message' => 'Akun not found'], 404);
    }
    $data = [
        'password' => Hash::make($request->password),
    ];
    $akun->update($data);
    $guru->update($data);
 
     return response()->json([
         'message' => 'success',
         'guru' => $guru,
         'akun' => $akun,
     ]);
    }
    public function delete($nip) {
        $akun = akun::whereNisp($nip)->first();
        $guru = guru::whereNip($nip)->first();
        if (!$guru) {
            return response()->json(['message' => 'Guru not found'], 404);
        }
        if (!$akun) {
            return response()->json(['message' => 'Akun not found'], 404);
        }
     guru::whereNip($nip)->delete();
     akun::whereNisp($nip)->delete();
     return response([
         'message' => 'success',
     ],200);
    }
}
