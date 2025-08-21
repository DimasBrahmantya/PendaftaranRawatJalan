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

    <!-- Filter Poli -->
    <form method="GET" class="mb-6 flex items-center space-x-4">
      <label for="poli" class="font-semibold">Pilih Poli:</label>
      <select name="poli" id="poli" class="border rounded-lg px-3 py-2">
        <option value="">Semua Poli</option>
        @foreach($listPoli as $poli)
          <option value="{{ $poli }}" {{ $filterPoli == $poli ? 'selected' : '' }}>
            {{ $poli }}
          </option>
        @endforeach
      </select>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Filter
      </button>
    </form>

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
          @forelse($pendaftaran as $item)
          <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->pasien->nama }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->poli }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_kunjungan }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nomor_antrian }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
              @if($item->status === 'Terdaftar')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Menunggu</span>
              @elseif($item->status === 'Dipanggil')
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Dipanggil</span>
              @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Selesai</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
