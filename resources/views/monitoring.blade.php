<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Monitoring Antrian</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 p-6">

  <div class="max-w-6xl mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-xl p-6">
    <h2 class="text-2xl font-bold mb-6">📺 Monitoring Antrian</h2>

    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-2 border">No</th>
          <th class="p-2 border">Nama Pasien</th>
          <th class="p-2 border">Poli</th>
          <th class="p-2 border">No Antrian</th>
          <th class="p-2 border">Status</th>
          <th class="p-2 border">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $i => $d)
        <tr id="row-{{ $d->id }}" class="border-b">
          <td class="p-2 border">{{ $i+1 }}</td>
          <td class="p-2 border">{{ $d->nama }}</td>
          <td class="p-2 border">{{ $d->poli }}</td>
          <td class="p-2 border">{{ $d->no_antrian }}</td>
          <td class="p-2 border">
            @if($d->status == 'Terdaftar')
              <span class="px-2 py-1 text-sm rounded bg-gray-100 text-gray-600">Terdaftar</span>
            @elseif($d->status == 'Dipanggil')
              <span class="px-2 py-1 text-sm rounded bg-blue-100 text-blue-600">Dipanggil</span>
            @else
              <span class="px-2 py-1 text-sm rounded bg-green-100 text-green-600">Selesai</span>
            @endif
          </td>
          <td class="p-2 border">
            @if($d->status == 'Terdaftar')
              <form action="{{ route('monitoring.panggil', $d->id) }}" method="GET">
                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Panggil</button>
              </form>
            @elseif($d->status == 'Dipanggil')
              <form action="{{ route('monitoring.selesai', $d->id) }}" method="GET">
                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Selesai</button>
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

  {{-- Pusher Realtime --}}
  <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
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

      if (pasien.status === "Terdaftar") {
        statusCell.innerHTML = `<span class="px-2 py-1 text-sm rounded bg-gray-100 text-gray-600">Terdaftar</span>`;
        aksiCell.innerHTML = `
          <form action="{{ url('/monitoring') }}/${pasien.id}/panggil" method="GET">
            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Panggil</button>
          </form>`;
      } else if (pasien.status === "Dipanggil") {
        statusCell.innerHTML = `<span class="px-2 py-1 text-sm rounded bg-blue-100 text-blue-600">Dipanggil</span>`;
        aksiCell.innerHTML = `
          <form action="{{ url('/monitoring') }}/${pasien.id}/selesai" method="GET">
            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">Selesai</button>
          </form>`;
      } else {
        statusCell.innerHTML = `<span class="px-2 py-1 text-sm rounded bg-green-100 text-green-600">Selesai</span>`;
        aksiCell.innerHTML   = `<span class="text-gray-400">-</span>`;
      }
    });
  </script>

</body>
</html>
