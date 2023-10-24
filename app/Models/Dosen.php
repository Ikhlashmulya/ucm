<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $guarded = [];

    public function jadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
