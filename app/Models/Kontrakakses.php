<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrakakses extends Model
{
    use HasFactory;

    protected $table = 'kontrak_akses';

    protected $guarded = [];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }
}
