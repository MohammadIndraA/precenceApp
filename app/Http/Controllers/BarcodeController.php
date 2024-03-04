<?php

namespace App\Http\Controllers;

use App\Models\barcode;
use App\Models\guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarcodeController extends Controller
{

        // get per guru

        public function getbyGuru($nip) {
            $day = date('Y-m-d');
            // dd($day);
            $guru = guru::whereNip($nip)->first();
            $data = barcode::with('mata_pelajaran')->where('guru_id',$guru->id)->whereDate('tanggal_barcode' ,$day)->orderBy('created_at', 'desc')->get();
            return response([
                'presensi' => $data,
            ],200);
        }
    public function index() {
        $barcode = barcode::all();
         return response([
             'barcode' => $barcode,
         ],200);
        }
        public function store(Request $request, $nis) {
        $guru = guru::whereNip($nis)->first();
        $data = [
         'barcode' => 'barcode',
         'tanggal_barcode' => now(),
         'mata_pelajaran_id' => $request->mata_pelajaran_id,
         'kelas_id' => $request->kelas_id,
         'guru_id' => $guru['id'],
        ];
        $bar = barcode::create($data);
     
         return response([
             'barcode' => $bar,
         ],200);
        }
        public function show($id) {
         $barcode = barcode::whereId($id)->get();
         return response([
             'barcode' => $barcode,
         ],200);
        }
        public function update(Request $request, $id) {
        $barcode = barcode::find($id);
        if (!$barcode) {
            return response()->json(['message' => 'Post not found'], 404);
        }
         $barcode->update($request->all());
     
         return response()->json([
             'messahe' => 'Berhasil Update',
             'barcode' => $barcode,
         ]);
        }
        public function delete($id) {
         barcode::whereId($id)->delete();
         return response([
             'messahe' => 'Berhasil delete',
         ],200);
        }
}
