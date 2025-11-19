<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PsyCheck</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50">

    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-screen w-64 bg-white flex flex-col justify-between shadow-xl border-r border-gray-200 z-50">
        <div>
            {{-- Logo Section --}}
            <div class="p-8 border-b border-gray-200">
                <div class="flex items-center justify-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl flex items-center justify-center shadow-lg">
                        <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold tracking-wide text-gray-800">PsyCheck</h1>
                </div>
                <p class="text-center text-xs text-gray-500 mt-5 font-medium">Admin Dashboard</p>
            </div>

            {{-- Navigation --}}
            <nav class="mt-8 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-5 py-4 rounded-xl transition-all duration-200 @if(request()->routeIs('admin.dashboard')) bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg shadow-indigo-500/30 @else text-gray-700 hover:bg-gray-100 hover:translate-x-1 @endif">
                    <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="{{ route('admin.questions.index') }}" class="flex items-center px-5 py-4 rounded-xl transition-all duration-200 @if(request()->routeIs('admin.questions.*')) bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg shadow-indigo-500/30 @else text-gray-700 hover:bg-gray-100 hover:translate-x-1 @endif">
                    <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">Soal</span>
                </a>
                <a href="{{ route('admin.responses.index') }}" class="flex items-center px-5 py-4 rounded-xl transition-all duration-200 @if(request()->routeIs('admin.responses.*')) bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg shadow-indigo-500/30 @else text-gray-700 hover:bg-gray-100 hover:translate-x-1 @endif">
                    <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <span class="font-semibold">Respon</span>
                </a>
            </nav>
        </div>
        
        {{-- User Info & Logout Section --}}
        <div class="border-t border-gray-200 p-5">
            @auth
            <div class="mb-4 p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-base">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            @endauth
            
            <form method="POST" action="{{ route('logout') }}"> 
                @csrf
                <button type="submit" class="flex items-center w-full px-5 py-4 text-left text-red-600 rounded-xl hover:bg-red-50 transition-all duration-200 hover:translate-x-1 group">
                    <svg class="w-5 h-5 mr-4 group-hover:text-red-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 min-h-screen">
        <div class="p-10">
            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-5 mb-8 rounded-xl shadow-md animate-fadeIn" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-700 p-5 mb-8 rounded-xl shadow-md animate-fadeIn" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
    
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</body>
</html>