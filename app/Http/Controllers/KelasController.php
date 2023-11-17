<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class KelasController extends Controller
{
   public function index() {
   $kelas = kelas::all();
    return response([
        'kelas' => $kelas,
    ],200);
   }
   public function store(Request $request) {
    $request->validate([
        'nama_kelas' => 'required',
        'jurusan' => 'required',
   ]);
   $kelas = kelas::latest()->first();
   $kode = "ROOM";
    if ($kelas == null) {
        // kode pertama
        $noUrut = "0001";
    }else{
        // kode selanjutnya
        $noUrut = substr($kelas->kode_kelas, 4,4)+1;
        $noUrut = str_pad($noUrut, 4 , "0", STR_PAD_LEFT);
    }
   $data = [
    'kode_kelas' => 'ROOM'.$noUrut,
    'nama_kelas' => $request->nama_kelas,
    'jurusan' =>$request->jurusan,
   ];
   $user = kelas::create($data);

    return response([
        'user' => $user,
    ],200);
   }
   public function show($id) {
    $kelas = kelas::whereId($id)->get();
    return response([
        'kelas' => $kelas,
    ],200);
   }
   public function update(Request $request,$id) {
    $validator = Validator::make($request->all(), [
        'kode_kelas' => 'required|max:10',
        'nama_kelas' => 'required',
        'jurusan' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    $data = $request->all();
   $kelas = kelas::whereId($id)->update($data);

    return response([
        'messahe' => 'Berhasil Update',
        'kelas' => $kelas,
    ]);
   }
   public function delete($id) {
    kelas::whereId($id)->delete();
    return response([
        'messahe' => 'Berhasil delete',
    ],200);
   }
}
