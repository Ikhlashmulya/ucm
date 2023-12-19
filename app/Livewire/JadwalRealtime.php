<?php

namespace App\Livewire;

use App\Models\Jadwal;
use Illuminate\Support\Carbon;
use Livewire\Component;

class JadwalRealtime extends Component
{
    public function checkTime(): string
    {
        return (string) Carbon::now('Asia/Jakarta')->format('H:m');
    }

    public function render()
    {
        return view('livewire.jadwal-realtime', [
            'jadwal' => Jadwal::paginate(10),
            'now' => $this->checkTime()
        ]);
    }
}
