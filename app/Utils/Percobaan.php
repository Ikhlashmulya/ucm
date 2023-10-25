<?php

namespace App\Utils;

use App\Models\Jadwal;
use App\Models\JamKampus;
use App\Models\Ruangan;

class Percobaan
{
    const TIME_SLOT_DURATION = 15;

    public static function mencariWaktu($className, $duration, int $interval, $startTime = null, $endTime = null, $day = null)
    {
        $class = Ruangan::where('nama_ruangan', $className)->firstOrFail()->id;
        if (is_null($startTime) || is_null($endTime)) {
            $jamKampus = JamKampus::firstOrFail();

            $startTime = strtotime($jamKampus->jam_mulai);
            $endTime = strtotime($jamKampus->jam_selesai);
        }

        $availableSlots = [];

        while ($startTime + $duration * 60 <= $endTime) {
            $isConflict = Jadwal::where('ruangan_id', $class)
                // ->where('hari', $day)
                ->where(function ($query) use ($startTime, $duration) {
                    // Apakah jam 08:00 lebih kecil dari jam 10:00 AND jam 10:00 lebih besar dari jam 08:00
                    $query->where('jam_mulai', '<', date('H:i', $startTime + $duration * 60))
                        ->where('jam_selesai', '>', date('H:i', $startTime));
                })
                ->orWhere(function ($query) use ($startTime) {
                    $query->where('jam_mulai', '<', date('H:i', $startTime))
                        ->where('jam_selesai', '>', date('H:i', $startTime));
                })
                ->exists();
            // dump($isConflict);
            if (!$isConflict) {
                $ks = strtotime($endTime) + ($interval * 60);
                if ($ks == strtotime($startTime) + ($interval * 60)) {
                    // dump($ks);
                    // Hitung waktu mulai dan waktu selesai untuk slot yang lebih besar
                    $slotStartTime = date('H:i', $startTime);
                    // dd($slotStartTime);
                    $slotEndTime = date('H:i', $startTime + $duration * 60);
                    // Tambahkan ke array hasil
                    $availableSlots[] = [
                        'jam_mulai' => date('H:i', strtotime($slotStartTime) + ($interval * 60)),
                        'jam_selesai' => date('H:i', strtotime($slotEndTime) + ($interval * 60)),
                    ];
                    // dump($availableSlots);
                    $ks = strtotime($startTime) + ($interval * 60);
                } else {
                    continue;
                }
            }

            $startTime += self::TIME_SLOT_DURATION * 60;
        }

        return $availableSlots;
    }
}
