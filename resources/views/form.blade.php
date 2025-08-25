<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pendaftaran Rawat Jalan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-10">

  <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-800">Form Pendaftaran Rawat Jalan</h2>
      <a href="{{ route('admisi.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">← Dashboard</a>
    </div>

    <form action="{{ route('daftar') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label class="block text-gray-600 font-medium mb-1">Nama</label>
        <input type="text" name="nama" placeholder="Masukkan nama lengkap"
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1">No KTP</label>
        <input type="text" name="no_ktp" id="no_ktp" maxlength="10" pattern="\d{10}" placeholder="Masukkan nomor KTP (10 digit)"
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
        <span id="ktp-warning" class="text-red-600 text-sm hidden mt-1">No KTP sudah terdaftar!</span>
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1">Alamat</label>
        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                  class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required></textarea>
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1">Jenis Pembayaran</label>
        <select name="jenis_pembayaran" id="jenis_pembayaran"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
          <option value="">-- Pilih Jenis Pembayaran --</option>
          <option value="BPJS">BPJS</option>
          <option value="Umum">Umum</option>
        </select>
      </div>

      <div id="no_bpjs_wrapper" class="hidden">
        <label class="block text-gray-600 font-medium mb-1">No BPJS</label>
        <input type="text" name="no_bpjs" id="no_bpjs" placeholder="Masukkan nomor BPJS"
               class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1">Poli</label>
        <select name="poli"
                class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
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

      <div class="text-right">
        <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-xl shadow hover:bg-green-700 transition">
          Daftar
        </button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const jenisPembayaran = document.getElementById('jenis_pembayaran');
      const noBpjsWrapper = document.getElementById('no_bpjs_wrapper');
      const noBpjsInput = document.getElementById('no_bpjs');
      const noKtpInput = document.getElementById('no_ktp');
      const ktpWarning = document.getElementById('ktp-warning');
      const form = document.querySelector('form');

      noKtpInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 10);
      });

      noKtpInput.addEventListener('blur', function () {
        if (this.value.length === 10) {
          $.get("{{ route('cek.ktp') }}", {
            no_ktp: this.value,
            nama: document.querySelector('input[name="nama"]').value
          }, function (res) {
            if (!res.valid){
              ktpWarning.textContent = "No KTP sudah digunakan oleh pasien lain!";
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
          noBpjsWrapper.classList.remove('hidden');
          noBpjsInput.setAttribute('required', 'required');
        } else {
          noBpjsWrapper.classList.add('hidden');
          noBpjsInput.removeAttribute('required');
          noBpjsInput.value = '';
        }
      });
    });
  </script>

</body>
</html>
