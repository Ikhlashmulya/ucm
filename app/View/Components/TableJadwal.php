<?php

namespace App\View\Components;

use App\Models\Jadwal;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableJadwal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $jadwal = Jadwal::paginate(2);
        return view('components.table-jadwal', compact('jadwal'));
    }
}