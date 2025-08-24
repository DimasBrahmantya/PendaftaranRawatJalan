<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Monitoring Antrian</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-white text-gray-800">

    <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold mb-6">📋 Monitoring Antrian</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nomor Antrian</th>
                    <th class="px-4 py-2 text-left">Nama Pasien</th>
                    <th class="px-4 py-2 text-left">Poli</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 font-semibold">{{ $d->nomor_antrian }}</td>
                        <td class="px-4 py-2">{{ $d->pasien->nama }}</td>
                        <td class="px-4 py-2">{{ $d->poli }}</td>
                        <td class="px-4 py-2">
                            @if($d->status === 'Dipanggil')
                                <span class="px-2 py-1 text-sm rounded bg-blue-100 text-blue-600">{{ $d->status }}</span>
                            @elseif($d->status === 'Selesai')
                                <span class="px-2 py-1 text-sm rounded bg-green-100 text-green-600">{{ $d->status }}</span>
                            @else
                                <span class="px-2 py-1 text-sm rounded bg-gray-100 text-gray-600">{{ $d->status }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            @if($d->status === 'Terdaftar')
                                <form action="{{ route('monitoring.panggil', $d->id) }}" method="GET">
                                    <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Panggil
                                    </button>
                                </form>
                            @elseif($d->status === 'Dipanggil')
                                <form action="{{ route('monitoring.selesai', $d->id) }}" method="GET">
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                        Selesai
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
