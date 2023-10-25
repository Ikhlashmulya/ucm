<?php

namespace App\Utils;

use App\Models\Jadwal;
use App\Models\JamKampus;
use App\Models\Ruangan;

class FindAvailableSlots
{
    const TIME_SLOT_DURATION = 15;

    public static function findAvailableSlots($className, $duration, $startTime = null, $endTime = null, $day)
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
                ->where('hari', $day)
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

            if (!$isConflict) {
                // Hitung waktu mulai dan waktu selesai untuk slot yang lebih besar
                $slotStartTime = date('H:i', $startTime);
                $slotEndTime = date('H:i', $startTime + $duration * 60);
                // Tambahkan ke array hasil
                $availableSlots[] = [
                    'jam_mulai' => $slotStartTime,
                    'jam_selesai' => $slotEndTime,
                ];
            }

            $startTime += self::TIME_SLOT_DURATION * 60;
        }

        return $availableSlots;
    }

    public static function getAvailableSlots()
    {
        $availableSlots = [];
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        foreach ($days as $day) {
            $availableSlots[] = [
                $day => self::findAvailableSlots('A201', 120, null, null, $day)
            ];
        }
        return $availableSlots;
    }
}
