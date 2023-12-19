<?php
use PHPUnit\Framework\TestCase;
use App\Utils\FindAvailableSlots;
use App\Models\JamKampus;
use App\Models\Jadwal;

class FindAvailableSlotsTest extends TestCase
{
    public function testFindAvailableSlots()
    {
        // Membuat instance FindAvailableSlots
        $findAvailableSlots = new FindAvailableSlots();

        // Membuat stub untuk JamKampus
        $jamKampusStub = $this->createStub(JamKampus::class);
        $jamKampusStub->method('firstOrFail')->willReturn((object)['jam_mulai' => '08:00', 'jam_selesai' => '17:00']);

        // Membuat stub untuk Jadwal
        $jadwalStub = $this->createStub(Jadwal::class);
        $jadwalStub->method('where')->willReturnSelf();
        $jadwalStub->method('orWhere')->willReturnSelf();
        $jadwalStub->method('exists')->willReturn(false);

        // Memasukkan stub ke dalam FindAvailableSlots
        $findAvailableSlots->setJamKampus($jamKampusStub);
        $findAvailableSlots->setJadwal($jadwalStub);

        // Memanggil metode untuk diuji
        $availableSlots = $findAvailableSlots->findAvailableSlots(1, 60);

        // Memeriksa hasilnya
        $this->assertEquals([
            ['jam_mulai' => '08:00', 'jam_selesai' => '09:00'],
            ['jam_mulai' => '09:15', 'jam_selesai' => '10:15'],
            ['jam_mulai' => '10:30', 'jam_selesai' => '11:30'],
            ['jam_mulai' => '11:45', 'jam_selesai' => '12:45'],
            ['jam_mulai' => '13:00', 'jam_selesai' => '14:00'],
            ['jam_mulai' => '14:15', 'jam_selesai' => '15:15'],
            ['jam_mulai' => '15:30', 'jam_selesai' => '16:30'],
            ['jam_mulai' => '16:45', 'jam_selesai' => '17:00'],
        ], $availableSlots);
    }
}
