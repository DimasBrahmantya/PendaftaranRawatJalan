<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admisi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-lg bg-white shadow-lg rounded-2xl p-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-semibold text-gray-800">Dashboard Admisi</h1>
      <a href="{{ route('admisi.logout') }}" 
         class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">Logout</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
      <a href="{{ route('admisi.form') }}" 
         class="flex items-center justify-center bg-blue-500 text-white font-medium py-4 rounded-xl shadow hover:bg-blue-600 transition">
        Form Pendaftaran
      </a>
      <a href="{{ route('admisi.monitoring') }}" 
         class="flex items-center justify-center bg-green-500 text-white font-medium py-4 rounded-xl shadow hover:bg-green-600 transition">
        Monitoring Antrian
      </a>
    </div>

    <p class="text-gray-500 text-center">Silahkan pilih menu Form atau Monitoring di atas.</p>
  </div>

</body>
</html>
