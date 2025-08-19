<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Monitoring</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 p-6">

  <div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">📋 Dashboard Monitoring Antrian</h1>

    <!-- Antrian yang sedang dipanggil -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h2 class="text-xl font-semibold">🔔 Antrian Sekarang</h2>
      @if($antrianSekarang)
        <p class="text-4xl font-bold text-red-600 mt-4">
          Nomor {{ $antrianSekarang->nomor_antrian }} - {{ $antrianSekarang->poli }}
        </p>
        <p class="mt-2 text-gray-600">Pasien: {{ $antrianSekarang->pasien->nama }}</p>
      @else
        <p class="text-gray-500 mt-4">Belum ada antrian yang dipanggil.</p>
      @endif
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-3 gap-4 mb-6">
      <div class="bg-blue-100 p-4 rounded-lg text-center">
        <p class="text-lg font-semibold">Total Pasien</p>
        <p class="text-2xl font-bold">{{ $totalPasien }}</p>
      </div>
      <div class="bg-green-100 p-4 rounded-lg text-center">
        <p class="text-lg font-semibold">Selesai</p>
        <p class="text-2xl font-bold">{{ $totalSelesai }}</p>
      </div>
      <div class="bg-yellow-100 p-4 rounded-lg text-center">
        <p class="text-lg font-semibold">Menunggu</p>
        <p class="text-2xl font-bold">{{ $totalMenunggu }}</p>
      </div>
    </div>

    <!-- Tabel Semua Antrian -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <h2 class="text-xl font-semibold mb-4">Daftar Antrian Hari Ini</h2>
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">No</th>
            <th class="border border-gray-300 px-4 py-2">Nama Pasien</th>
            <th class="border border-gray-300 px-4 py-2">Poli</th>
            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
            <th class="border border-gray-300 px-4 py-2">No Antrian</th>
            <th class="border border-gray-300 px-4 py-2">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendaftaran as $item)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->pasien->nama }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->poli }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_kunjungan }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nomor_antrian }}</td>
            <td class="border border-gray-300 px-4 py-2">
              @if($item->status == 'Terdaftar')
                <span class="text-yellow-600 font-semibold">Menunggu</span>
              @else
                <span class="text-green-600 font-semibold">Selesai</span>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
