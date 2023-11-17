<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mataPelajaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function barcodes(){
        return $this->hasMany(barcode::class);
     }
}
