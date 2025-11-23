@extends('layouts.app')

@section('content')
<main class="min-h-screen pt-32 pb-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-10 md:p-12 rounded-2xl shadow-lg">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-3"></i>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-3"></i>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <header class="mb-10 text-center">
                <div class="inline-block p-3 md:p-4 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-2xl mb-4 shadow-lg">
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-indigo-600 mb-3 md:mb-4 px-2">
                    Hasil Tes Kesehatan Mental
                </h1>
                <p class="text-base md:text-lg text-gray-600 font-medium px-2">
                    Penilaian untuk <strong>{{ $participant->name }}</strong>
                </p>
                <p class="text-xs md:text-sm text-gray-500 mt-2 px-2">
                    📅 Tanggal Tes: {{ \Carbon\Carbon::parse($participant->date_of_test)->timezone('Asia/Jakarta')->format('d F Y H:i') }}
                </p>
            </header>
            
            <!-- Participant Info Card -->
            <section class="mb-10 p-4 md:p-6 bg-gray-50 border border-gray-100 rounded-xl">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    Informasi Peserta
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                    <div class="flex items-center space-x-3 p-3 md:p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-base md:text-lg">{{ $participant->age }}</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Usia</p>
                            <p class="text-xs md:text-sm font-bold text-gray-800">{{ $participant->age }} tahun</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 md:p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Jenis Kelamin</p>
                            <p class="text-xs md:text-sm font-bold text-gray-800">{{ $participant->gender }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 md:p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Tgl Lahir</p>
                            <p class="text-xs md:text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($participant->date_of_birth)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 md:p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 font-medium">Email</p>
                            <p class="text-xs md:text-sm font-bold text-gray-800 truncate">{{ $participant->email ?? 'Tidak Diberikan' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Results Section -->
            <section class="mb-10 space-y-4 md:space-y-6">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-4 md:mb-6 flex items-center">
                    <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                    Skor & Kategori
                </h2>
                
                @php
                $results = [
                    ['label' => 'Depresi', 'score' => $participant->result->score_depression, 'category' => $participant->result->category_depression, 'color' => 'indigo'],
                    ['label' => 'Kecemasan (Anxiety)', 'score' => $participant->result->score_anxiety, 'category' => $participant->result->category_anxiety, 'color' => 'blue'],
                    ['label' => 'Stres', 'score' => $participant->result->score_stress, 'category' => $participant->result->category_stress, 'color' => 'purple'],
                ];
                @endphp

                @foreach($results as $res)
                    <div class="relative overflow-hidden rounded-xl md:rounded-2xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                        @if($res['color'] == 'indigo')
                            <div class="absolute top-0 left-0 w-1.5 md:w-2 h-full bg-gradient-to-b from-indigo-400 via-indigo-500 to-indigo-600"></div>
                        @elseif($res['color'] == 'blue')
                            <div class="absolute top-0 left-0 w-1.5 md:w-2 h-full bg-gradient-to-b from-blue-400 via-blue-500 to-blue-600"></div>
                        @else
                            <div class="absolute top-0 left-0 w-1.5 md:w-2 h-full bg-gradient-to-b from-purple-400 via-purple-500 to-purple-600"></div>
                        @endif
                            
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 md:p-6 pl-6 md:pl-10 gap-4">
                            <div class="flex-1">
                                <p class="text-lg md:text-xl font-bold text-gray-900 mb-1">{{ $res['label'] }}</p>
                            </div> 
                            
                            <div class="flex items-center gap-3 md:gap-4 w-full sm:w-auto justify-between sm:justify-end">
                                @if($res['color'] == 'indigo')
                                    <div class="flex flex-col items-center justify-center w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl shadow-lg">
                                        <span class="text-3xl md:text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-indigo-100 mt-1">Skor</span>
                                    </div>
                                @elseif($res['color'] == 'blue')
                                    <div class="flex flex-col items-center justify-center w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg">
                                        <span class="text-3xl md:text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-blue-100 mt-1">Skor</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg">
                                        <span class="text-3xl md:text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-purple-100 mt-1">Skor</span>
                                    </div>
                                @endif
                                
                                <div class="flex justify-center min-w-[100px] md:min-w-[144px]">
                                    <span class="px-3 md:px-4 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-bold inline-flex items-center justify-center whitespace-nowrap shadow-md
                                        @if($res['category'] == 'Normal') bg-gradient-to-r from-green-400 to-green-500 text-white
                                        @elseif($res['category'] == 'Ringan') bg-gradient-to-r from-yellow-400 to-yellow-500 text-white
                                        @elseif($res['category'] == 'Sedang') bg-gradient-to-r from-orange-400 to-orange-500 text-white
                                        @elseif($res['category'] == 'Berat') bg-gradient-to-r from-red-400 to-red-500 text-white
                                        @else bg-gradient-to-r from-red-600 to-red-700 text-white @endif
                                    ">
                                        {{ $res['category'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            {{-- SECTION REKOMENDASI --}}
            <section class="mt-8 md:mt-12 p-6 md:p-8 bg-gradient-to-br from-indigo-50 to-purple-50 border-l-4 border-indigo-600 rounded-xl md:rounded-2xl shadow-lg">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-3 md:mb-4 flex items-center">
                    <svg class="w-6 h-6 md:w-7 md:h-7 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Rekomendasi Tindak Lanjut
                </h2>
                @php
                    $maxScore = max(
                        $participant->result->score_depression, 
                        $participant->result->score_anxiety, 
                        $participant->result->score_stress
                    );
                    
                    if ($maxScore <= 13) {
                        $recommendationText = "Kondisi emosional Anda stabil atau dalam kategori Ringan. Pertahankan rutinitas sehat seperti tidur cukup, olahraga teratur, dan koneksi sosial. Deteksi dini berhasil!";
                    } elseif ($maxScore <= 25) {
                        $recommendationText = "Skor Anda berada di kategori Sedang. Ini saatnya untuk mulai mencari bantuan mandiri: pelajari teknik relaksasi, manajemen stres, dan pertimbangkan berbicara dengan orang terpercaya.";
                    } else {
                        $recommendationText = "Skor Anda berada di kategori Berat/Sangat Berat. Kami sangat menganjurkan Anda untuk segera mencari bantuan profesional (Psikolog/Psikiater) untuk evaluasi dan penanganan lebih lanjut.";
                    }
                @endphp
                <div class="bg-white/80 p-4 md:p-6 rounded-xl">
                    <p class="text-sm md:text-base text-gray-700 leading-relaxed font-medium">{{ $recommendationText }}</p>
                </div>
            </section>
            
            {{-- Info Box tentang Kerahasiaan --}}
            <section class="mt-8 md:mt-10 p-4 md:p-6 bg-blue-50 border-l-4 border-blue-500 rounded-xl">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <i data-lucide="shield-check" class="w-5 h-5 md:w-6 md:h-6 text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base md:text-lg font-bold text-blue-900 mb-2">Catatan Penting</h3>
                        <p class="text-xs md:text-sm text-blue-800 leading-relaxed">
                            Sesuai dengan standar etika psikologi Indonesia (HIMPSI), detail jawaban per item tidak ditampilkan untuk menjaga validitas dan reliabilitas alat tes. Hasil yang ditampilkan adalah interpretasi agregat yang telah divalidasi secara ilmiah. Untuk konsultasi lebih lanjut, silakan hubungi psikolog profesional.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="mt-8 md:mt-12 pt-6 md:pt-8 border-t border-gray-200">
                <div class="text-center mb-6 md:mb-8">
                    <div class="inline-flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-indigo-100 rounded-full mb-4">
                        <svg class="w-7 h-7 md:w-8 md:h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-sm md:text-base text-gray-700 font-medium mb-2 px-4">Terima kasih telah berpartisipasi dalam Tes Kesehatan Mental ini</p>
                    <p class="text-xs md:text-sm text-gray-500 px-4">Hasil ini disajikan untuk tujuan skrining dan bukan diagnosis klinis</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row md:justify-center gap-3 md:gap-5 md:px-2">  
                    <a href="{{ route('landing') }}" class="inline-flex items-center justify-center px-5 md:px-6 py-2.5 md:py-3 bg-indigo-600 text-white text-sm md:text-base font-semibold rounded-lg hover:bg-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>

                    @if($participant->email)
                    <button 
                        onclick="showPaymentModal()"
                        class="inline-flex items-center justify-center px-5 md:px-6 py-2.5 md:py-3 bg-indigo-600 text-white text-sm md:text-base font-semibold rounded-lg hover:bg-indigo-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 cursor-pointer"
                    >
                        <i data-lucide="mail" class="w-4 h-4 md:w-5 md:h-5 mr-2"></i>
                        Kirim Hasil ke Email
                        <span class="ml-2 px-2 py-0.5 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">Premium</span>
                    </button>
                    @endif
                </div>
            </footer>
        </div>
    </div>
</main>

<!-- Payment Modal (Simulasi) -->
<div id="paymentModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="paymentModalContent" class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-6 md:p-8 transform transition-all duration-300 scale-95 max-h-[90vh] overflow-y-auto">
        <!-- Step 1: Method Selection -->
        <div id="methodSelection">
            <div class="text-center mb-6">
                <div class="mx-auto flex items-center justify-center h-14 w-14 md:h-16 md:w-16 rounded-full bg-gradient-to-br from-yellow-100 to-orange-100 mb-4">
                    <i data-lucide="crown" class="w-8 h-8 md:w-10 md:h-10 text-yellow-600"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Fitur Premium</h3>
                <p class="text-sm md:text-base text-gray-600 px-2">
                    Dapatkan hasil tes lengkap dikirim ke email Anda
                </p>
            </div>

            <!-- Pricing Card -->
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 border-2 border-indigo-200 rounded-xl p-5 md:p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs md:text-sm text-gray-600">Total Pembayaran</p>
                        <div class="flex items-baseline">
                            <span class="text-3xl md:text-4xl font-bold text-indigo-600">Rp 15.000</span>
                        </div>
                    </div>
                    <div class="text-4xl md:text-5xl">📧</div>
                </div>
                
                <div class="space-y-2 text-xs md:text-sm">
                    <div class="flex items-center text-gray-700">
                        <i data-lucide="check" class="w-4 h-4 text-green-600 mr-2 flex-shrink-0"></i>
                        <span>Hasil lengkap dalam format email</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i data-lucide="check" class="w-4 h-4 text-green-600 mr-2 flex-shrink-0"></i>
                        <span>Skor untuk 3 dimensi (D, A, S)</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i data-lucide="check" class="w-4 h-4 text-green-600 mr-2 flex-shrink-0"></i>
                        <span>Rekomendasi tindak lanjut</span>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="mb-6">
                <p class="text-xs md:text-sm font-semibold text-gray-700 mb-3">Pilih Metode Pembayaran</p>
                <div class="space-y-2">
                    <label class="flex items-center justify-between p-3 md:p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition has-[:checked]:border-green-600 has-[:checked]:bg-green-50">
                        <div class="flex items-center gap-2 md:gap-3">
                            <input type="radio" name="payment_method" value="gopay" class="w-4 h-4 md:w-5 md:h-5 text-green-600 flex-shrink-0" checked>
                            <div class="flex items-center flex-wrap gap-1 md:gap-2">
                                <span class="font-bold text-green-600 text-base md:text-lg">GoPay</span>
                                <span class="px-1.5 md:px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded-full">QRIS</span>
                            </div>
                        </div>
                    </label>
                    <label class="flex items-center justify-between p-3 md:p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-purple-500 transition has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50">
                        <div class="flex items-center gap-2 md:gap-3">
                            <input type="radio" name="payment_method" value="ovo" class="w-4 h-4 md:w-5 md:h-5 text-purple-600 flex-shrink-0">
                            <span class="font-bold text-purple-600 text-base md:text-lg">OVO</span>
                        </div>
                    </label>
                    <label class="flex items-center justify-between p-3 md:p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition has-[:checked]:border-blue-600 has-[:checked]:bg-blue-50">
                        <div class="flex items-center gap-2 md:gap-3">
                            <input type="radio" name="payment_method" value="dana" class="w-4 h-4 md:w-5 md:h-5 text-blue-600 flex-shrink-0">
                            <span class="font-bold text-blue-600 text-base md:text-lg">DANA</span>
                        </div>
                    </label>
                    <label class="flex items-center justify-between p-3 md:p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-500 transition has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50">
                        <div class="flex items-center gap-2 md:gap-3">
                            <input type="radio" name="payment_method" value="bank" class="w-4 h-4 md:w-5 md:h-5 text-indigo-600 flex-shrink-0">
                            <span class="font-bold text-indigo-600 text-base md:text-lg">Transfer Bank</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button 
                    type="button"
                    onclick="closePaymentModal()"
                    class="flex-1 px-4 md:px-6 py-2.5 md:py-3 border-2 border-gray-300 rounded-lg font-semibold text-sm md:text-base text-gray-700 hover:bg-gray-100 transition cursor-pointer"
                >
                    Batal
                </button>
                <button 
                    type="button"
                    onclick="showQRCode()"
                    class="flex-1 px-4 md:px-6 py-2.5 md:py-3 bg-indigo-600 text-white rounded-lg font-bold text-sm md:text-base hover:bg-indigo-800 transition shadow-md flex items-center justify-center cursor-pointer"
                >
                    <i data-lucide="arrow-right" class="w-4 h-4 md:w-5 md:h-5 mr-2"></i>
                    Lanjutkan
                </button>
            </div>
        </div>

        <!-- Step 2: QR Code Payment -->
        <div id="qrCodeSection" class="hidden">
            <div class="text-center mb-6 relative">
                <button onclick="backToMethodSelection()" class="absolute top-0 left-0 p-2 hover:bg-gray-100 rounded-lg transition">
                    <i data-lucide="arrow-left" class="w-5 h-5 text-gray-600"></i>
                </button>
                <div id="paymentMethodIcon" class="mx-auto flex items-center justify-center h-14 w-14 md:h-16 md:w-16 rounded-full bg-green-100 mb-4">
                    <i data-lucide="smartphone" class="w-7 h-7 md:w-8 md:h-8 text-green-600"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-1">Scan QR Code</h3>
                <p class="text-sm md:text-base text-gray-600" id="paymentMethodName">GoPay</p>
            </div>

            <!-- Timer -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 md:p-4 mb-6 rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i data-lucide="clock" class="w-4 h-4 md:w-5 md:h-5 text-yellow-600 mr-2 flex-shrink-0"></i>
                        <span class="text-xs md:text-sm font-semibold text-yellow-800">Waktu tersisa:</span>
                    </div>
                    <span id="paymentTimer" class="text-lg md:text-xl font-bold text-yellow-600">2:00</span>
                </div>
            </div>

            <!-- QR Code -->
            <div class="bg-white border-4 border-gray-200 rounded-2xl p-6 md:p-8 mb-6 flex justify-center">
                <div class="text-center">
                    <img id="qrCodeImage" src="" alt="QR Code" class="w-48 h-48 md:w-64 md:h-64 mx-auto mb-4">
                    <p class="text-xs md:text-sm text-gray-500 px-2">Scan kode QR dengan aplikasi pembayaran</p>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs md:text-sm text-gray-600">Merchant</span>
                    <span class="font-bold text-sm md:text-base text-gray-900">PsyCheck</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs md:text-sm text-gray-600">ID Transaksi</span>
                    <span class="font-mono text-xs md:text-sm font-semibold text-gray-900" id="transactionId">PSY-xxxxx</span>
                </div>
                <div class="flex justify-between items-center border-t pt-2 mt-2">
                    <span class="text-xs md:text-sm text-gray-600 font-semibold">Total</span>
                    <span class="font-bold text-indigo-600 text-lg md:text-xl">Rp 15.000</span>
                </div>
            </div>

            <!-- Simulated Payment Button -->
            <button 
                type="button"
                onclick="simulatePaymentSuccess()"
                class="w-full px-5 md:px-6 py-3 md:py-4 bg-green-600 text-white text-sm md:text-base rounded-lg font-bold hover:bg-green-800 transition shadow-lg flex items-center justify-center cursor-pointer"
            >
                <i data-lucide="zap" class="w-4 h-4 md:w-5 md:h-5 mr-2"></i>
                Klik untuk Membayar 
            </button>
            <p class="text-xs text-center text-gray-500 mt-2 px-2">
                Seluruh transaksi sudah diawasi oleh OJK
            </p>
        </div>
    </div>
</div>

<!-- Payment Success Modal -->
<div id="successModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="successModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 md:p-8 transform transition-all duration-300 scale-95">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 md:h-20 md:w-20 rounded-full bg-green-100 mb-4 animate-bounce">
                <i data-lucide="check-circle" class="w-10 h-10 md:w-12 md:h-12 text-green-600"></i>
            </div>
            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil! 🎉</h3>
            <p class="text-sm md:text-base text-gray-600 mb-6 px-2">
                Email sedang dikirim ke:<br>
                <span class="font-bold text-indigo-600 break-all">{{ $participant->email }}</span>
            </p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4 mb-6">
                <p class="text-xs md:text-sm text-blue-900">
                    <i data-lucide="info" class="w-4 h-4 inline mr-1"></i>
                    Mohon cek inbox atau folder spam Anda dalam 1-2 menit.
                </p>
            </div>

            <form action="{{ route('dass.results.send.email', $participant->id) }}" method="POST" id="actualEmailForm">
                @csrf
                <button 
                    type="submit"
                    class="w-full px-5 md:px-6 py-2.5 md:py-3 bg-indigo-600 text-white text-sm md:text-base rounded-lg font-bold hover:bg-indigo-700 transition cursor-pointer"
                    id="finalSendBtn"
                >
                    OK, Kirim Email
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    let paymentTimer;
    let timeLeft = 120;

    // Payment Modal Functions
    function showPaymentModal() {
        const modal = document.getElementById('paymentModal');
        const modalContent = document.getElementById('paymentModalContent');
        
        // Reset to method selection
        document.getElementById('methodSelection').classList.remove('hidden');
        document.getElementById('qrCodeSection').classList.add('hidden');
        
        modal.classList.remove('hidden');
        lucide.createIcons();
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        const modalContent = document.getElementById('paymentModalContent');
        
        // Clear timer
        if (paymentTimer) {
            clearInterval(paymentTimer);
        }
        
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function showQRCode() {
        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
        
        // Hide method selection, show QR code
        document.getElementById('methodSelection').classList.add('hidden');
        document.getElementById('qrCodeSection').classList.remove('hidden');
        
        // Update UI based on payment method
        const methodConfig = {
            gopay: { name: 'GoPay', icon: 'smartphone', bgColor: 'bg-green-100', iconColor: 'text-green-600' },
            ovo: { name: 'OVO', icon: 'wallet', bgColor: 'bg-purple-100', iconColor: 'text-purple-600' },
            dana: { name: 'DANA', icon: 'credit-card', bgColor: 'bg-blue-100', iconColor: 'text-blue-600' },
            bank: { name: 'Transfer Bank', icon: 'building-2', bgColor: 'bg-indigo-100', iconColor: 'text-indigo-600' }
        };
        
        const config = methodConfig[selectedMethod];
        const iconContainer = document.getElementById('paymentMethodIcon');
        
        // Update payment method name
        document.getElementById('paymentMethodName').textContent = config.name;
        
        // Update icon container background color
        iconContainer.className = `mx-auto flex items-center justify-center h-16 w-16 rounded-full ${config.bgColor} mb-4`;
        
        // Update icon
        iconContainer.innerHTML = `<i data-lucide="${config.icon}" class="w-8 h-8 ${config.iconColor}"></i>`;
        
        // Generate random transaction ID
        const transactionId = 'PSY-' + Math.random().toString(36).substr(2, 9).toUpperCase();
        document.getElementById('transactionId').textContent = transactionId;
        
        // Generate QR Code using API
        const qrData = `PSYCHECK|${config.name}|15000|${transactionId}`;
        const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(qrData)}`;
        document.getElementById('qrCodeImage').src = qrCodeUrl;
        
        // Start countdown timer
        timeLeft = 120; // Reset to 2 minutes
        startPaymentTimer();
        
        lucide.createIcons();
    }

    function backToMethodSelection() {
        document.getElementById('qrCodeSection').classList.add('hidden');
        document.getElementById('methodSelection').classList.remove('hidden');
        
        // Clear timer
        if (paymentTimer) {
            clearInterval(paymentTimer);
        }
        
        lucide.createIcons();
    }

    function startPaymentTimer() {
        const timerElement = document.getElementById('paymentTimer');
        
        paymentTimer = setInterval(() => {
            timeLeft--;
            
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            
            // Change color when time is running out
            if (timeLeft <= 60) {
                timerElement.classList.add('text-red-600');
                timerElement.classList.remove('text-yellow-600');
            }
            
            // Timer expired
            if (timeLeft <= 0) {
                clearInterval(paymentTimer);
                alert('Waktu pembayaran habis. Silakan coba lagi.');
                closePaymentModal();
            }
        }, 1000);
    }

    function simulatePaymentSuccess() {
        // Clear timer
        if (paymentTimer) {
            clearInterval(paymentTimer);
        }
        
        // Show loading
        const btn = event.target;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses pembayaran...';
        
        // Simulate payment processing
        setTimeout(() => {
            closePaymentModal();
            
            setTimeout(() => {
                showSuccessModal();
            }, 400);
        }, 2000);
    }

    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        const modalContent = document.getElementById('successModalContent');
        
        modal.classList.remove('hidden');
        lucide.createIcons();
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    // Close modals when clicking outside
    document.getElementById('paymentModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closePaymentModal();
        }
    });

    // Handle actual email form submission
    document.getElementById('actualEmailForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('finalSendBtn');
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Mengirim...';
    });

    // Clear timer session saat hasil ditampilkan
    sessionStorage.removeItem('dassTestStartTime');
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    
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
</style>
@endsection