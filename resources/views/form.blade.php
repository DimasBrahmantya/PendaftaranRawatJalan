<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pendaftaran Rawat Jalan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Tambahkan jQuery untuk AJAX -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10">
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="bg-blue-600 text-white text-center py-4">
      <h3 class="text-xl font-semibold">Form Pendaftaran Rawat Jalan</h3>
    </div>
    <div class="p-6">
      <form action="{{ route('daftar') }}" method="POST" class="space-y-4">
        @csrf
        
        <!-- Nama -->
        <div>
          <label class="block font-medium mb-1">Nama</label>
          <input type="text" name="nama" placeholder="Masukkan nama lengkap"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>

        <!-- No KTP -->
        <div>
          <label class="block font-medium mb-1">No KTP</label>
          <input type="text" name="no_ktp" id="no_ktp" maxlength="10" pattern="\d{10}" placeholder="Masukkan nomor KTP (10 digit)"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
          <span id="ktp-warning" class="text-red-600 text-sm hidden">No KTP sudah terdaftar!</span>
        </div>

        <!-- Tanggal Lahir -->
        <div>
          <label class="block font-medium mb-1">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
        </div>

        <!-- Alamat -->
        <div>
          <label class="block font-medium mb-1">Alamat</label>
          <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required></textarea>
        </div>

        <!-- Jenis Pembayaran -->
        <div>
          <label class="block font-medium mb-1">Jenis Pembayaran</label>
          <select name="jenis_pembayaran" id="jenis_pembayaran"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
            <option value="">-- Pilih Jenis Pembayaran --</option>
            <option value="BPJS">BPJS</option>
            <option value="Umum">Umum</option>
          </select>
        </div>

        <!-- No BPJS (Tersembunyi default) -->
        <div id="no_bpjs_wrapper" style="display: none;">
          <label class="block font-medium mb-1">No BPJS</label>
          <input type="text" name="no_bpjs" id="no_bpjs" placeholder="Masukkan nomor BPJS"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Poli -->
        <div>
          <label class="block font-medium mb-1">Poli</label>
          <select name="poli"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required>
            <option value="">-- Pilih Poli Tujuan --</option>
            <option value="Poli Umum">Poli Umum</option>
            <option value="Poli Gigi">Poli Gigi</option>
            <option value="Poli Anak">Poli Anak</option>
            <option value="Poli Kandungan">Poli Kandungan</option>
            <option value="Poli THT">Poli THT</option>
            <option value="Poli Mata">Poli Mata</option>
            <option value="Poli Bedah">Poli Bedah</option>
            <option value="Poli Jantung">Poli Jantung</option>
            <option value="Poli Paru">Poli Paru</option>
            <option value="Poli Kulit">Poli Kulit</option>
            <option value="Poli Saraf">Poli Saraf</option>
          </select>
        </div>

        <!-- Tombol Submit -->
        <div class="text-right">
          <button type="submit"
            class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
            Daftar
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Script untuk toggle input No BPJS -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const jenisPembayaran = document.getElementById('jenis_pembayaran');
    const noBpjsWrapper = document.getElementById('no_bpjs_wrapper');
    const noBpjsInput = document.getElementById('no_bpjs');
    const noKtpInput = document.getElementById('no_ktp');
    const ktpWarning = document.getElementById('ktp-warning');
    const form = document.querySelector('form');

    // Limit input hanya angka dan maksimal 10 digit
    noKtpInput.addEventListener('input', function () {
      this.value = this.value.replace(/\D/g, '').slice(0, 10);
    });

    // AJAX cek KTP duplikat
    noKtpInput.addEventListener('blur', function () {
      if (this.value.length === 10) {
        $.get("{{ route('cek.ktp') }}", { no_ktp: this.value }, function(res) {
          if (res.exists) {
            ktpWarning.classList.remove('hidden');
            form.querySelector('button[type="submit"]').disabled = true;
          } else {
            ktpWarning.classList.add('hidden');
            form.querySelector('button[type="submit"]').disabled = false;
          }
        });
      } else {
        ktpWarning.classList.add('hidden');
        form.querySelector('button[type="submit"]').disabled = false;
      }
    });

    jenisPembayaran.addEventListener('change', function () {
      if (this.value === 'BPJS') {
        noBpjsWrapper.style.display = 'block';
        noBpjsInput.setAttribute('required', 'required');
      } else {
        noBpjsWrapper.style.display = 'none';
        noBpjsInput.removeAttribute('required');
        noBpjsInput.value = '';
      }
    });
  });
</script>

</body>
</html>
