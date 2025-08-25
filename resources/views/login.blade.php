<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admisi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Login Admisi</h2>

    <form action="{{ route('admisi.login.submit') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block text-gray-600 mb-1">Username</label>
        <input type="text" name="username" 
               class="w-full border border-gray-300 px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
               required>
      </div>
      <div>
        <label class="block text-gray-600 mb-1">Password</label>
        <input type="password" name="password" 
               class="w-full border border-gray-300 px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" 
               required>
      </div>
      <button type="submit" 
              class="w-full bg-blue-600 text-white py-2 rounded-xl shadow hover:bg-blue-700 transition">
        Login
      </button>
    </form>

    <p class="text-gray-400 text-sm text-center mt-4">Masukkan username dan password Anda untuk masuk.</p>
  </div>

</body>
</html>
