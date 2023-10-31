<?php

namespace App\Utils;

use App\Models\Ruangan;

class FindAvailableClass
{
    public static function find($hari, $jamMulai, $jamSelesai)
    {
        $ruangan =  Ruangan::join('jadwal', 'jadwal.ruangan_id', '=', 'ruangan.id')
            ->where('jadwal.hari', $hari)
            ->where('jadwal.jam_mulai', '!=', $jamMulai)
            ->where('jadwal.jam_selesai', '!=', $jamSelesai)
            ->select('ruangan.nama_ruangan')
            ->get()
            ->toArray();

        return $ruangan;
    }
}
