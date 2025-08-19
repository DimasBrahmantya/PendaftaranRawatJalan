
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Nomor Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @media print {
      .btn-print, .btn-back {
        display: none;
      }
    }
  </style>
</head>
<body class="bg-gray-100 font-sans">

<div class="w-[350px] mx-auto bg-white p-6 rounded-2xl shadow-lg text-center mt-10">
  <h4 class="text-lg font-semibold">🏥 RS Rawat Jalan</h4>
  <hr class="border-dashed border-gray-300 my-4">

  <p class="text-base">Nama: <b>{{ $data->pasien->nama }}</b></p>
  <p class="text-base">Poli: <b>{{ $data->poli }}</b></p>
  <p class="text-base">
    Tanggal: 
    <b>{{ \Carbon\Carbon::parse($data->tanggal_kunjungan)->format('d/m/Y') }}</b>
  </p>

  <h1 class="text-6xl font-bold text-blue-600 my-4">{{ $data->nomor_antrian }}</h1>

  <hr class="border-dashed border-gray-300 my-4">

  <button onclick="window.print()" 
    class="btn-print bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
    🖨 Cetak
  </button>

  <a href="{{ route('form') }}" 
    class="btn-back inline-block bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg ml-2 transition">
    ⬅ Kembali
  </a>
</div>

</body>
</html>
