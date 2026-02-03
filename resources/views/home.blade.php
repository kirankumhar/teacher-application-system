<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="w-full max-w-4xl">
        
        <header class="mb-12 text-center">
            <h1 class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">Teacher Application System</h1>
            <p class="max-w-2xl mx-auto text-lg text-gray-600">Welcome! Choose your login or registration option below.</p>
        </header>

        <main class="p-6 bg-white shadow-xl rounded-2xl md:p-10">

            
            <div class="pt-8 mt-12 border-t border-gray-100">
                <div class="text-center">
                    {{-- <h3 class="mb-6 text-xl font-bold text-gray-800">Main Action Buttons</h3>
                    <p class="max-w-2xl mx-auto mb-8 text-gray-600">These are the two main buttons for the primary actions on this page. Click them to see the interaction.</p> --}}
                    
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ route('login') }}"  id="mainBtn1" class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl hover:from-blue-600 hover:to-indigo-700 hover:-translate-y-1 hover:shadow-xl">
                            Login
                        </a>
                        
                        <a href="{{ route('applicant.register') }}" id="mainBtn2" class="flex items-center gap-3 px-8 py-4 text-lg font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl hover:from-emerald-600 hover:to-green-700 hover:-translate-y-1 hover:shadow-xl">
                            Applicant Registration
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>