<div wire:poll.60s='checkTime()'>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Ruangan</th>
                <th scope="col" class="px-6 py-3">Dosen</th>
                <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                <th scope="col" class="px-6 py-3">Waktu</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Rincian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $j)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="p-3">
                            <div class="text-base font-semibold">{{ $j->ruangan->nama_ruangan }}</div>
                        </div>
                    </th>
                    <td class="py-4 text-xs">{{ $j->dosen->nama }}</td>
                    <td class="px-6 py-4">{{ $j->mataKuliah->nama_matkul }}</td>
                    <td class="px-6 py-4 flex-nowrap">{{ $j->jam_mulai }}-{{ $j->jam_selesai }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if ($now >= $j->jam_mulai && $now <= $j->jam_selesai)
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                Terisi
                            @else
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                Kosong
                            @endif

                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <a href="#" type="button" data-modal-target="editUserModal"
                            data-modal-show="editUserModal"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Rincian</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5">
        {{ $jadwal->links() }}
    </div>
    <!-- Modal -->
    <livewire:modal />
</div>
