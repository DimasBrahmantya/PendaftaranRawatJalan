<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monitoring Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen p-4">

<div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-6">
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-3 sm:mb-0">📺 Monitoring Antrian</h2>
    <a href="{{ route('admisi.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">← Kembali ke Dashboard</a>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse">
      <thead>
        <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
          <th class="p-3 border">No</th>
          <th class="p-3 border">Nama Pasien</th>
          <th class="p-3 border">Poli</th>
          <th class="p-3 border">No Antrian</th>
          <th class="p-3 border">Status</th>
          <th class="p-3 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $i => $d)
        <tr id="row-{{ $d->id }}" class="border-b hover:bg-gray-50 transition">
          <td class="p-2 border text-center">{{ $i+1 }}</td>
          <td class="p-2 border">{{ $d->pasien->nama }}</td>
          <td class="p-2 border">{{ $d->poli }}</td>
          <td class="p-2 border text-center">{{ $d->nomor_antrian }}</td>
          <td class="p-2 border text-center">
            @if($d->status == 'Terdaftar')
              <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">Terdaftar</span>
            @elseif($d->status == 'Dipanggil')
              <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-medium">Dipanggil</span>
            @else
              <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-medium">Selesai</span>
            @endif
          </td>
          <td class="p-2 border text-center">
            @if($d->status == 'Terdaftar')
              <form action="{{ route('monitoring.panggil', $d->id) }}" method="GET">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">Panggil</button>
              </form>
            @elseif($d->status == 'Dipanggil')
              <form action="{{ route('monitoring.selesai', $d->id) }}" method="GET">
                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition">Selesai</button>
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
</div>

<script>
  var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
  });

  var channel = pusher.subscribe('antrian');
  channel.bind('App\\Events\\PasienDipanggil', function(data) {
    let pasien = data.pendaftaran;
    const row = document.querySelector(`#row-${pasien.id}`);
    if (!row) return;

    const statusCell = row.querySelector("td:nth-child(5)");
    const aksiCell   = row.querySelector("td:nth-child(6)");
    const nameCell   = row.querySelector("td:nth-child(2)");
    const nomorCell  = row.querySelector("td:nth-child(4)");

    // Update status badge
    if (pasien.status === "Terdaftar") {
      statusCell.innerHTML = `<span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">Terdaftar</span>`;
      aksiCell.innerHTML = `<form action="{{ url('/monitoring') }}/${pasien.id}/panggil" method="GET"><button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">Panggil</button></form>`;
    } else if (pasien.status === "Dipanggil") {
      statusCell.innerHTML = `<span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-medium">Dipanggil</span>`;
      aksiCell.innerHTML = `<form action="{{ url('/monitoring') }}/${pasien.id}/selesai" method="GET"><button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 transition">Selesai</button></form>`;
    } else {
      statusCell.innerHTML = `<span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs font-medium">Selesai</span>`;
      aksiCell.innerHTML   = `<span class="text-gray-400">-</span>`;
    }

    // Update nama & nomor antrian
    nameCell.innerText = pasien.pasien.nama;
    nomorCell.innerText = pasien.nomor_antrian;
  });
</script>

</body>
</html>
