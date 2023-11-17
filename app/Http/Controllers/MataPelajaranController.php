<?php

namespace App\Http\Controllers;

use App\Models\mataPelajaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon as IlluminateCarbon;
IlluminateCarbon::setLocale('id');
class MataPelajaranController extends Controller
{
    public function index() {
        $mata_pelajaran = mataPelajaran::all();
         return response([
             'mata_pelajaran' => $mata_pelajaran,
         ],200);
        }
        public function store(Request $request) {
         $request->validate([
             'mata_pelajaran' => 'required',
             'hari' => 'required',
             'jam' => 'required',
             'kelas_id' => 'required',
             'guru_id' => 'required',
        ]);
        $kode = mataPelajaran::latest()->first();
        if ($kode == null) {
            // kode pertama
            $noUrut = "0001";
        }else{
            // kode selanjutnya
            $noUrut = substr($kode->kode_pelajaran, 5,4)+1;
            $noUrut = str_pad($noUrut, 4 , "0", STR_PAD_LEFT);
        }
        $data = [
         'kode_pelajaran' => 'MAPEL'.$noUrut,
         'mata_pelajaran' => $request->mata_pelajaran,
         'hari' =>$request->hari,
         'jam' => $request->jam,
         'kelas_id' => $request->kelas_id,
         'guru_id' =>$request->guru_id,
        ];
        $mapel = mataPelajaran::create($data);
     
         return response([
             'mapel' => $mapel,
         ],200);
        }
        public function show($id) {
         $mata_pelajaran = mataPelajaran::whereId($id)->get();
         return response([
             'mata_pelajaran' => $mata_pelajaran,
         ],200);
        }
        public function showPerDay() {
        $hariIni = Carbon::now()->isoFormat('dddd');
        // dd($hariIni);
         $mata_pelajaran = mataPelajaran::where('hari',$hariIni)->first();
         return response([
             'mata_pelajaran' => $mata_pelajaran,
         ],200);
        }
        public function update(Request $request, $id) {
         $validator = Validator::make($request->all(), [
            'kode_pelajaran' => 'required|max:10',
            'mata_pelajaran' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'kelas_id' => 'required',
            'guru_id' => 'required',
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }
        $mata_pelajaran = mataPelajaran::find($id);
        if (!$mata_pelajaran) {
            return response()->json(['message' => 'Post not found'], 404);
        }
         $mata_pelajaran->update($request->all());
     
         return response()->json([
             'messahe' => 'Berhasil Update',
             'mata_pelajaran' => $mata_pelajaran,
         ]);
        }
        public function delete($id) {
         mataPelajaran::whereId($id)->delete();
         return response([
             'messahe' => 'Berhasil delete',
         ],200);
        }
}
