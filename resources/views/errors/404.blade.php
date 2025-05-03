<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Page Not Found</title>
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
      text-shadow: 0 0 15px rgba(99, 102, 241, 0.6);
      animation: pulseGlow 2s ease-in-out infinite;
    }
    @keyframes pulseGlow {
      0%, 100% { text-shadow: 0 0 15px rgba(99, 102, 241, 0.6); }
      50% { text-shadow: 0 0 30px rgba(99, 102, 241, 0.9); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="error-container max-w-xl w-full rounded-2xl shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 text-center">
      <div class="text-9xl font-black text-white glow">404</div>
      <h1 class="text-2xl font-semibold text-white mt-2">Oops! This page is missing</h1>
    </div>
    <div class="p-8 text-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-indigo-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <p class="text-gray-600 mb-8 leading-relaxed">
        Oops! We can't find that page. It looks like you've reached a page that doesn't exist.
      </p>
      <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 justify-center">
        <a href="{{url('/')}}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-all transform hover:-translate-y-1 shadow-lg">
          Take Me Home 
        </a>
        <button onclick="history.back()" class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all">
          Go Back 
        </button>
      </div>
    </div>
  </div>
</body>
</html>
