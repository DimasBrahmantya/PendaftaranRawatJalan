<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register Admisi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register Admisi</h2>

    @if ($errors->any())
      <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required
          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" required
          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
          class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none">
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
        Daftar
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-5">
      Sudah punya akun?
      <a href="{{ route('admisi.login') }}" class="text-blue-600 font-medium hover:underline">
        Login di sini
      </a>
    </p>
  </div>

</body>
</html>
