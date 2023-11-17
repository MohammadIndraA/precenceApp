<?php

namespace App\Http\Controllers;

use App\Models\akun;
use App\Models\guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
      
       $request->validate([
            'nis' => 'required|max:16|unique:users',
            'nama_lengkap' => 'required',
            'no_telepon' => 'required|max:15',
            'nama_ortu' => 'required',
            'no_telepon_ortu' => 'required|max:15',
            'alamat_lengkap' => 'required',
            'password' => 'required',
       ]);
     
       $akun = akun::create([
        'nisp' => $request->nis,
        'password' => Hash::make($request->password),
        'level' => 'siswa',
       ]);
       $akuns = akun::whereNisp($akun->nisp)->first();
       $data = [
        'nis' => $request->nis,
        'nama_lengkap' => $request->nama_lengkap,
        'no_telepon' => $request->no_telepon,
        'nama_ortu' => $request->nama_ortu,
        'no_telepon_ortu' => $request->no_telepon_ortu,
        'alamat_lengkap' => $request->alamat_lengkap,
        'level' => 'siswa',
        'akun_id' => $akuns['id'],
        'password' => Hash::make($request->password),
       ];
       $user = User::create($data);

     
       $token = $user->createToken('smart_presence')->plainTextToken;

        return response([
            'user' => $user,
            'akun' => $akun ,
            'token' => $token,
        ],201);
    }
    public function login(Request $request) {
        $request->validate([
            'nisp' => 'required|max:16',
            'password' => 'required',
       ]);
        $user = akun::whereNisp($request->nisp)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid Crediancial'
            ], 422);
        }
        $token = $user->createToken('smart_presence')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
        }
    // public function login(Request $request) {
    //     $request->validate([
    //         'nis' => 'required|min:10',
    //         'password' => 'required',
    //    ]);
    //     $user = User::whereNis($request->nis)->first();
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response([
    //             'message' => 'Invalid Crediancial'
    //         ], 422);
    //     }
    //     $token = $user->createToken('smart_presence')->plainTextToken;
    //     return response([
    //         'user' => $user,
    //         'token' => $token,
    //     ], 200);
    //     }
    public function loginAdmin(Request $request) {
        $request->validate([
            'nisp' => 'required|max:16',
            'password' => 'required',
       ]);
       $user = akun::whereNisp($request->nisp)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Invalid Credentials'
            ], 401);
        }
        
        if ($user->level !== "Admin") {
            return response()->json([
                'error' => 'Hanya admin yang bisa login'
            ], 403);
        }
       $token = $user->createToken('smart_presence')->plainTextToken;
       return response([
           'user' => $user,
           'token' => $token,
       ], 200);
       }
    
}
