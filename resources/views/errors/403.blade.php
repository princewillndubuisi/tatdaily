<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Access Denied</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .glow {
      text-shadow: 0 0 15px rgba(251, 191, 36, 0.6);
      animation: pulseGlow 2s ease-in-out infinite;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="error-container max-w-xl w-full rounded-2xl shadow-2xl overflow-hidden">
    <div class="bg-yellow-400 p-6 text-center">
      <div class="text-9xl font-black text-white glow">403</div>
      <h1 class="text-2xl font-semibold text-white mt-2">Hold Up! You can't go there</h1>
    </div>
    <div class="p-8 text-center">
      <p class="text-gray-700 mb-8 leading-relaxed">
        You don’t have permission to access this page. If you think this is a mistake, please contact support.
      </p>
      <a href="{{url('/')}}" class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-all shadow-lg">
        Return to Home
      </a>
    </div>
  </div>
</body>
</html>
