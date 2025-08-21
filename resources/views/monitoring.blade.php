<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring Antrian</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white text-gray-800">

    <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            📋 Monitoring Antrian Hari Ini
        </h2>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow-md">
            <table class="min-w-full border-collapse bg-white text-sm">
                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Pasien</th>
                        <th class="px-4 py-3 text-left">Poli</th>
                        <th class="px-4 py-3 text-center">Nomor Antrian</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data as $i => $d)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $i+1 }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $d->pasien->nama }}</td>
                        <td class="px-4 py-3">{{ $d->poli }}</td>
                        <td class="px-4 py-3 text-center font-bold text-indigo-600">{{ $d->nomor_antrian }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($d->status === 'Terdaftar')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Terdaftar
                                </span>
                            @elseif($d->status === 'Dipanggil')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    Dipanggil
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center flex gap-2 justify-center">
                            {{-- Tombol Panggil (hanya kalau Terdaftar) --}}
                            @if($d->status === 'Terdaftar')
                                <form action="{{ route('monitoring.panggil', $d->id) }}" method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-1.5 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition font-medium shadow-sm">
                                        Panggil
                                    </button>
                                </form>
                            @endif

                            {{-- Tombol Selesai (hanya kalau Dipanggil) --}}
                            @if($d->status === 'Dipanggil')
                                <form action="{{ route('monitoring.selesai', $d->id) }}" method="GET">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-1.5 rounded-lg text-white bg-green-600 hover:bg-green-700 transition font-medium shadow-sm">
                                        Selesai
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data antrian
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
