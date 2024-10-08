<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $fillable = ['indek_berkas', 'kode_klasifikasi_arsip', 'tanggal_penyelesaian', 'isi', 'disampaikan_kepada', 'kepada', 'tanggal', 'pukul', 'surat_masuk_id'];

    protected $casts = [
        'pukul' => 'datetime'
    ];

    public function suratMasuk()
    {
        return $this->belongsTo(SuratMasuk::class);
    }

    public function disampaikanKepada()
    {
        return $this->hasMany(DisampaikanKepada::class);
    }
}
