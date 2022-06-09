<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $table = 'kontrak';

    protected $guarded = [];

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class,'pekerjaan_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
    public function progressterakhir()
    {
        return $this->hasOne(Progress::class)->latest();
    }
  
    public function spk()
    {
        return $this->hasMany(Dokumenspk::class);
    }

    public function bast()
    {
        return $this->hasOne(Bast::class);
    }
}
