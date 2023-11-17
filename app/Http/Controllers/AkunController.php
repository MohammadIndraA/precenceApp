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
    public function index() {
        $akun = akun::all();
         return response([
             'akun' => $akun,
         ],200);
        }
        public function store(Request $request) {
         $request->validate([
             'nisp' => 'required|max:10|unique:akuns',
             'password' => 'required',
             'level' => 'required',
        ]);
        $data = [
         'nisp' => $request->nisp,
         'password' => $request->password,
         'level' => $request->level,
        ];
        $akun = akun::create($data);
        if ($request['level'] == "siswa") {
          User::create([
            'nis' => $request->nisp,
            'password' => $request->password,
            'level' => $request->level,
            'akun_id' => $akun['id'],
          ]);
        }else{
            guru::create([
                'nip' => $request->nisp,
                'password' => $request->password,
                'level' => $request->level,
                'akun_id' => $akun['id'],
            ]);
        }
         return response([
             'akun' => $akun,
         ],200);
        }
        public function show($id) {
         $akun = akun::whereId($id)->get();
         return response([
             'akun' => $akun,
         ],200);
        }
        public function showakun($id) {
         $akun = akun::whereId($id)->first();
         return response([
             'akun' => $akun,
         ],200);
        }
        public function update(Request $request, $id) {
         $validator = Validator::make($request->all(), [
            'nikp' => 'required|max:10',
             'password' => 'required',
             'level' => 'required',
         ]);
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }
        $akun = akun::find($id);
        if (!$akun) {
            return response()->json(['message' => 'Post not found'], 404);
        }
         $akun->update($request->all());
     
         return response()->json([
             'messahe' => 'Berhasil Update',
             'akun' => $akun,
         ]);
        }
        public function delete($id) {
         akun::whereId($id)->delete();
         return response([
             'messahe' => 'Berhasil delete',
         ],200);
        }
}
