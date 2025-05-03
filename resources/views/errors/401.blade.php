<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Unauthorized</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .glow {
      text-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
      animation: pulseGlow 2s ease-in-out infinite;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="error-container max-w-xl w-full rounded-2xl shadow-2xl overflow-hidden">
    <div class="bg-blue-600 p-6 text-center">
      <div class="text-9xl font-black text-white glow">401</div>
      <h1 class="text-2xl font-semibold text-white mt-2">Access Restricted</h1>
    </div>
    <div class="p-8 text-center">
      <p class="text-gray-600 mb-8 leading-relaxed">
        You need to be logged in to view this page. Please sign in and try again.
      </p>
      <a href="{{route('login')}}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-lg">
        Go to Login
      </a>
    </div>
  </div>
</body>
</html>
