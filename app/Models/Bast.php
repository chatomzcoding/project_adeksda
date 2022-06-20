<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    protected $table = 'bast';

    protected $guarded = [];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }
}
