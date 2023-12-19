<div class="relative flex flex-col justify-center overflow-x-auto shadow-md sm:rounded-lg ">
    <table class="w-full mt-10 text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Hari</th>
                <th scope="col" class="px-6 py-3">Waktu</th>
                <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                <th scope="col" class="px-6 py-3">SKS</th>
                <th scope="col" class="px-6 py-3">Dosen</th>
                <th scope="col" class="px-6 py-3">SEM</th>
                <th scope="col" class="px-6 py-3">Prodi</th>
                <th scope="col" class="px-6 py-3">Ruang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $j)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $j->hari }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $j->mataKuliah->nama_matkul }}
                    </th>
                    <td class="px-6 py-4">{{ $j->sks }}</td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $j->dosen->nama }}
                    </td>
                    <td class="px-6 py-4">{{ $j->semester }}</td>
                    <td class="px-6 py-4">{{ $j->prodi->nama_prodi }}</td>
                    <td class="px-6 py-4">{{ $j->ruangan->nama_ruangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="p-5">
    {{ $jadwal->links() }}
</div>