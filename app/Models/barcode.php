<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barcode extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function presensi(){
        return $this->belongsTo(presensi::class);
     }
   
    public function mata_pelajaran(){
        return $this->belongsTo(mataPelajaran::class, 'id', 'id_mapel');
     }
    public function user(){
        return $this->belongsTo(User::class);
     }
   
}
