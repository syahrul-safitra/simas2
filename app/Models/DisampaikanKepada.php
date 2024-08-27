<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisampaikanKepada extends Model
{
    use HasFactory;

    protected $fillable = [
        'disposisi_id',
        'user_id',
        'catatan',
        'selesai',
        'arsipkan'
    ];

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class);
    }
}
