<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Something Went Wrong</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .error-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
    }
    .glow {
      text-shadow: 0 0 15px rgba(239, 68, 68, 0.6);
      animation: pulseGlow 2s ease-in-out infinite;
    }
    @keyframes pulseGlow {
      0%, 100% { text-shadow: 0 0 15px rgba(239, 68, 68, 0.6); }
      50% { text-shadow: 0 0 30px rgba(239, 68, 68, 0.9); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="error-container max-w-xl w-full rounded-2xl shadow-2xl overflow-hidden">
    <div class="bg-red-600 p-6 text-center">
      <div class="text-9xl font-black text-white glow">500</div>
      <h1 class="text-2xl font-semibold text-white mt-2">Whoops! Something went wrong</h1>
    </div>
    <div class="p-8 text-center">
      <p class="text-gray-600 mb-8 leading-relaxed">
        Our server is having a moment. We’re working on fixing it — please try again shortly.
      </p>
      <a href="{{url('/')}}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-lg">
        Back to Home
      </a>
    </div>
  </div>
</body>
</html>
