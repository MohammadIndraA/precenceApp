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
    public function views() {
        
        $mapel = mataPelajaran::all();
        return view("admin.mapel.index", compact('mapel'));
    }
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
         'kelas_id' => 0,
         'guru_id' =>0,
        ];
        $mapel = mataPelajaran::create($data);
     
         return response([
             'mapel' => $mapel,
             'message' => 'success',
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
         $mata_pelajaran = mataPelajaran::where('hari',$hariIni)->get();
         return response([
             'mata_pelajaran' => $mata_pelajaran,
         ],200);
        }
        public function update(Request $request, $id) {
         $validator = Validator::make($request->all(), [
            'mata_pelajaran' => 'required',
            'hari' => 'required',
            'jam' => 'required',
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
             'message' => 'success',
             'mata_pelajaran' => $mata_pelajaran,
         ]);
        }
        public function delete($id) {
         mataPelajaran::whereId($id)->delete();
         return response([
            'message' => 'success',
         ],200);
        }
}
