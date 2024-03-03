<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    
    public function views() {
        $akun = akun::with('user')->get();
        return view("admin.akun.index",compact('akun'));
    }
    public function index() {
        $akun = akun::all();
         return response([
             'akun' => $akun,
         ],200);
        }
        public function store(Request $request) {
            $request->validate([
                'nisp' => 'required|max:10|unique:akuns',
                'password_ex' => 'required',
                'level' => 'required',
            ]);
        
            $data = [
                'nisp' => $request->nisp,
                'password_ex' => $request->password, // Store the password as plain text
                'level' => $request->level,
            ];
        
            $akun = akun::create($data);
        
            if ($request['level'] == "siswa") {
                User::create([
                    'nis' => $request->nisp,
                    'password' => $request->password, // Store the password as plain text
                    'level' => $request->level,
                    'akun_id' => $akun['id'],
                ]);
            } else {
                guru::create([
                    'nip' => $request->nisp,
                    'password' => $request->password, // Store the password as plain text
                    'level' => $request->level,
                    'akun_id' => $akun['id'],
                ]);
            }
        
            return response([
                'akun' => $akun,
                'message' => 'success',
            ], 200);
        }
        
        public function show($nis) {
         $akun = akun::whereNisp($nis)->get();
         return response([
             'akun' => $akun,
             'message' => 'success',
         ],200);
        }
        public function showakun($id) {
         $akun = akun::whereId($id)->first();
         return response([
             'akun' => $akun,
         ],200);
        }
        public function update(Request $request, $nis) {
         $validator = Validator::make($request->all(), [
            'nisp' => 'required|max:20',
             'level' => 'required',
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }
        $akun = akun::whereNisp($nis)->first();
        $guru = guru::whereNip($nis)->first();
        $siswa = User::whereNis($nis)->first();
        if (!$akun) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        if ($akun->level == "Siswa") {
            $akun->update($request->all());
            $siswa['nis'] = $request->nisp;
            $siswa->update();
        }else{
            $akun->update($request->all());
            $guru['nip'] = $request->nisp;
            $guru->update();
        }
     
         return response()->json([
             'message' => 'success',
             'akun' => $akun,
         ]);
        }
        public function delete($nis) {
        $akun = akun::whereNisp($nis)->first();
            if ($akun->level == "Siswa") {
                akun::whereNisp($nis)->delete();
                User::whereNis($nis)->delete();
            }else{
                akun::whereNisp($nis)->delete();
                guru::whereNip($nis)->delete();
            }
         return response([
             'message' => 'success',
         ],200);
        }
        
}
