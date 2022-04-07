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

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
  
    public function spk()
    {
        return $this->hasMany(Dokumenspk::class);
    }
}
