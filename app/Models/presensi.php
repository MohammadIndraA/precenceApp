<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presensi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
     }
    public function guru(){
        return $this->belongsTo(guru::class);
     }
     public function barcodes(){
        return $this->belongsTo(barcode::class);
     }
     public function mata_pelajaran(){
        return $this->belongsTo(mataPelajaran::class, 'id_mapel');
     }
}
