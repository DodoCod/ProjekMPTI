@extends('layouts.app')

@section('content')
<main class="min-h-screen pt-32 pb-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">     
        <div class="bg-white px-8 py-8 md:px-12 md:py-10 rounded-xl shadow-2xl shadow-indigo-300/40 border border-indigo-100">

            <header class="mb-6 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-indigo-800 mb-2">
                    Langkah 2: Tes Kesehatan Mental
                </h1>
                <p class="text-gray-600">
                    Jawab pertanyaan ini sesuai kondisi Anda <span class="font-semibold text-indigo-700">selama satu minggu terakhir</span>.
                </p>
            </header>

            {{-- Timer Display --}}
            <div class="mb-6 bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-xl border border-indigo-200 transition-all duration-300" id="timerContainer">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-2 rounded-lg shadow-sm">
                            <i data-lucide="clock" class="w-6 h-6 text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sisa Waktu</p>
                            <p class="text-2xl font-bold text-indigo-800" id="timerDisplay">10:00</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Batas waktu pengerjaan</p>
                        <p class="text-sm font-semibold text-indigo-700">10 Menit</p>
                    </div>
                </div>
            </div>

            {{-- Warning Banner (Hidden by default) --}}
            <div id="warningBanner" class="hidden mb-6 bg-red-50 border-2 border-red-400 p-4 rounded-xl opacity-0 transform translate-y-[-10px] transition-all duration-500 ease-out">
                <div class="flex items-center gap-3">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600 flex-shrink-0 animate-bounce"></i>
                    <div>
                        <p class="font-bold text-red-800">Perhatian! Waktu hampir habis</p>
                        <p class="text-sm text-red-700">Sisa waktu kurang dari 1 menit. Segera selesaikan tes Anda.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-sm font-medium text-gray-700 mb-2 text-center">
                    Pertanyaan {{ $step }} dari {{ $totalQuestions }}
                </p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div 
                        class="bg-indigo-600 h-2 rounded-full transition-all duration-700 ease-out shadow-inner" 
                        style="width: {{ ($step / $totalQuestions) * 100 }}%"
                    ></div>
                </div>
            </div>

            <form action="{{ route('dass.test.submit.step') }}" method="POST" class="space-y-5" id="testForm">
                @csrf
                <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                <input type="hidden" name="step" value="{{ $step }}">
                <input type="hidden" name="time_expired" id="timeExpiredInput" value="0">
                <input type="hidden" name="participant_id" value="{{ $participantId }}">

                <div class="bg-gray-50 p-6 md:p-7 rounded-xl shadow-inner border border-gray-100">  
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 leading-snug">
                        {{ $currentQuestion->text }}
                    </h2>
                    
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm font-medium" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="space-y-3">
                        @php
                            $options = [
                                0 => 'Tidak sesuai dengan kondisi saya sama sekali',
                                1 => 'Cukup sesuai dengan kondisi saya',
                                2 => 'Sesuai dengan kondisi saya',
                                3 => 'Sangat sesuai dengan kondisi saya',
                            ];
                        @endphp

                        @foreach($options as $score => $text)
                            <label class="flex items-center space-x-4 cursor-pointer p-4 rounded-lg border border-gray-300 transition-all duration-200 
                                          hover:border-indigo-500 hover:bg-indigo-50 
                                          has-checked:bg-indigo-100 has-checked:border-indigo-100 has-checked:ring-2 has-checked:ring-indigo-300">
                                <input 
                                    type="radio" 
                                    name="score" 
                                    value="{{ $score }}" 
                                    required
                                    @if($savedAnswer !== null && $savedAnswer == $score) checked @endif
                                    class="h-6 w-6 text-indigo-600 border-2 border-gray-400 focus:ring-indigo-500 transition duration-150"
                                >
                                <span class="text-gray-900 font-medium text-base">{{ $text }}</span>
                            </label>
                        @endforeach
                        @error('score')
                            <p class="mt-2 text-sm text-red-600">Mohon pilih salah satu jawaban.</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-3">                   
                    @if ($step < $totalQuestions)
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-indigo-700 transition duration-150 shadow-md flex items-center cursor-pointer">
                            Selanjutnya
                            <i data-lucide="chevron-right" class="w-6 h-6 ml-1"></i>
                        </button>
                    @else
                        <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-teal-700 transition duration-150 shadow-md flex items-center cursor-pointer">
                            Selesai & Lihat Hasil
                            <i data-lucide="check" class="w-6 h-6 ml-1"></i>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>

{{-- Timer Modal (Time's Up) --}}
<div id="timeUpModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i data-lucide="clock" class="w-10 h-10 text-red-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Waktu Habis!</h3>
            <p class="text-gray-600 mb-6">
                Batas waktu pengerjaan tes telah berakhir. Jawaban Anda akan disimpan secara otomatis.
            </p>
            <button 
                onclick="submitFormAutomatic()" 
                class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition"
            >
                Simpan & Lanjutkan
            </button>
        </div>
    </div>
</div>

<script>
    // Timer Configuration - SESUAIKAN DURASI DI SINI (dalam detik)
    const TOTAL_TIME = 10 * 60; // 10 menit = 600 detik
    const WARNING_TIME = 1 * 60; // 1 menit = 60 detik
    
    let timeRemaining = TOTAL_TIME;
    let timerInterval;
    let warningShown = false;
    let timerStartTime = null;

    // Initialize timer when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Check if timer has already started (from sessionStorage)
        const savedStartTime = sessionStorage.getItem('dassTestStartTime');
        
        if (savedStartTime) {
            // Timer sudah pernah dimulai, hitung sisa waktu
            timerStartTime = parseInt(savedStartTime);
            const elapsedTime = Math.floor((Date.now() - timerStartTime) / 1000);
            timeRemaining = TOTAL_TIME - elapsedTime;
            
            // Jika waktu sudah habis
            if (timeRemaining <= 0) {
                timeRemaining = 0;
                showTimeUpModal();
                return;
            }
            
            // Check if warning should already be shown
            if (timeRemaining <= WARNING_TIME) {
                warningShown = true;
                showWarning();
            }
        } else {
            // Timer baru dimulai untuk pertama kali
            timerStartTime = Date.now();
            sessionStorage.setItem('dassTestStartTime', timerStartTime);
            timeRemaining = TOTAL_TIME;
        }
        
        startTimer();
        lucide.createIcons(); // Initialize Lucide icons
    });

    function startTimer() {
        // Update display immediately
        updateTimerDisplay();
        
        timerInterval = setInterval(function() {
            timeRemaining--;
            
            // Update display
            updateTimerDisplay();
            
            // Check for warning (1 minute remaining)
            if (timeRemaining <= WARNING_TIME && !warningShown) {
                showWarning();
                warningShown = true;
            }
            
            // Check if time's up
            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                showTimeUpModal();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        const display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        
        document.getElementById('timerDisplay').textContent = display;
        
        // Change color when time is running out
        const timerContainer = document.getElementById('timerContainer');
        const timerDisplay = document.getElementById('timerDisplay');
        
        if (timeRemaining <= WARNING_TIME) {
            timerContainer.classList.remove('from-indigo-50', 'to-purple-50', 'border-indigo-200');
            timerContainer.classList.add('from-red-50', 'to-orange-50', 'border-red-300', 'animate-pulse');
            timerDisplay.classList.remove('text-indigo-800');
            timerDisplay.classList.add('text-red-700');
        }
    }

    function showWarning() {
        const warningBanner = document.getElementById('warningBanner');
        // Remove hidden first, then trigger animation
        warningBanner.classList.remove('hidden');
        
        // Use setTimeout to ensure hidden is removed before animation starts
        setTimeout(() => {
            warningBanner.classList.remove('opacity-0', 'translate-y-[-10px]');
            warningBanner.classList.add('opacity-100', 'translate-y-0');
        }, 10);
        
        // Refresh lucide icons for the warning banner
        lucide.createIcons();
        
        // Play notification sound (optional)
        // const audio = new Audio('/path/to/notification.mp3');
        // audio.play();
        
        // Browser notification (optional, requires permission)
        if ("Notification" in window && Notification.permission === "granted") {
            new Notification("PsyCheck - Waktu Hampir Habis", {
                body: "Sisa waktu pengerjaan tes kurang dari 1 menit!",
                icon: "/path/to/icon.png"
            });
        }
    }

    function showTimeUpModal() {
        document.getElementById('timeUpModal').classList.remove('hidden');
        document.getElementById('timeExpiredInput').value = '1';
        lucide.createIcons(); // Refresh icons in modal
    }

    function submitFormAutomatic() {
        // Set flag that time has expired
        document.getElementById('timeExpiredInput').value = '1';
        
        // Auto-select first option if nothing selected
        const scoreInputs = document.querySelectorAll('input[name="score"]');
        let isSelected = false;
        
        scoreInputs.forEach(input => {
            if (input.checked) isSelected = true;
        });
        
        if (!isSelected && scoreInputs.length > 0) {
            scoreInputs[0].checked = true;
        }
        
        // Clear session storage
        sessionStorage.removeItem('dassTestStartTime');
        
        // Submit form normally - let the backend handle redirect to result
        document.getElementById('testForm').submit();
    }

    // Clear timer when leaving page
    window.addEventListener('beforeunload', function() {
        clearInterval(timerInterval);
    });

    // Request notification permission on page load
    if ("Notification" in window && Notification.permission === "default") {
        Notification.requestPermission();
    }
    
    // Clear session when test is complete (call this from your result page)
    function clearTestTimer() {
        sessionStorage.removeItem('dassTestStartTime');
    }
</script>

<style>
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .7;
        }
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endsection