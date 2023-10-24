<?php

use App\Models\Dosen;
use App\Models\Gedung;
use App\Models\MataKuliah;
use App\Models\Prodi;
use App\Models\Ruangan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sks');
            $table->unsignedInteger('semester');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->foreignIdFor(Dosen::class);
            $table->foreignIdFor(Prodi::class);
            $table->foreignIdFor(Ruangan::class);
            $table->foreignIdFor(MataKuliah::class);
            $table->unique(['sks', 'semester', 'jam_mulai', 'jam_selesai', 'hari', 'dosen_id', 'prodi_id', 'ruangan_id', 'mata_kuliah_id'], 'jadwal_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
