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
        $tempSlotEndTime = date('H:i', $startTime + $duration * 60);
        $iterate = 0;

        while ($startTime + $duration * 60 <= $endTime) {
            $isConflict = Jadwal::where('ruangan_id', $class)
                ->where(function ($query) use ($startTime, $duration) {
                    $query->where('jam_mulai', '<', date('H:i', $startTime + $duration * 60))
                        ->where('jam_selesai', '>', date('H:i', $startTime));
                })
                ->orWhere(function ($query) use ($startTime) {
                    $query->where('jam_mulai', '<', date('H:i', $startTime))
                        ->where('jam_selesai', '>', date('H:i', $startTime));
                })
                ->exists();
            if (!$isConflict) {
                $slotStartTime = date('H:i', $startTime);
                $slotEndTime = date('H:i', $startTime + $duration * 60);

                if ($slotStartTime === $tempSlotEndTime) {
                    $availableSlots[] = [
                        'jam_mulai' => date('H:i', strtotime($slotStartTime) + (($interval * 60) * $iterate)),
                        'jam_selesai' => date('H:i', strtotime($slotEndTime) + (($interval * 60) * $iterate)),
                    ];
                    $tempSlotEndTime = $slotEndTime;
                    $iterate++;
                }
            }

            $startTime += self::TIME_SLOT_DURATION * 60;
        }

        return $availableSlots;
    }
}
