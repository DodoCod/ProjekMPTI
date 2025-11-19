@extends('layouts.app')

@section('content')
<main class="min-h-screen pt-32 pb-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-10 md:p-12 rounded-2xl shadow-lg">
            <!-- Header Section -->
            <header class="mb-10 text-center">
                <div class="inline-block p-4 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-2xl mb-4 shadow-lg">
                    {{-- Icon File/Document --}}
                    <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold bg-indigo-600 bg-clip-text text-transparent mb-4">
                    Hasil Tes DASS-42 Anda
                </h1>
                <p class="text-lg text-gray-600 font-medium">
                    Penilaian untuk <strong>{{ $participant->name }}</strong>
                </p>
                <p class="text-sm text-gray-500 mt-2">
                    📅 Tanggal Tes: {{ \Carbon\Carbon::parse($participant->date_of_test)->format('d F Y H:i') }}
                </p>
            </header>
            
            <!-- Participant Info Card -->
            <section class="mb-10 p-6 bg-gray-50 border border-gray-100 rounded-xl">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    Informasi Peserta
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">{{ $participant->age }}</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Usia</p>
                            <p class="text-sm font-bold text-gray-800">{{ $participant->age }} tahun</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Jenis Kelamin</p>
                            <p class="text-sm font-bold text-gray-800">{{ $participant->gender }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Tgl Lahir</p>
                            <p class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($participant->date_of_birth)->format('d M Y') }}</p>
                        </div>
                    </div>
                    {{-- Email --}}
                    <div class="flex items-center space-x-3 p-4 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-indigo-100">
                        <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs text-gray-500 font-medium">Email</p>
                            <p class="text-sm font-bold text-gray-800 truncate">{{ $participant->email ?? 'Tidak Diberikan' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Results Section -->
            <section class="mb-10 space-y-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                    Skor & Kategori
                </h2>
                
                @php
                $results = [
                    ['label' => 'Depresi', 'score' => $participant->result->score_depression, 'category' => $participant->result->category_depression, 'color' => 'indigo', 'gradient' => 'from-indigo-500 to-indigo-600'],
                    ['label' => 'Kecemasan (Anxiety)', 'score' => $participant->result->score_anxiety, 'category' => $participant->result->category_anxiety, 'color' => 'blue', 'gradient' => 'from-blue-500 to-blue-600'],
                    ['label' => 'Stres', 'score' => $participant->result->score_stress, 'category' => $participant->result->category_stress, 'color' => 'purple', 'gradient' => 'from-purple-500 to-purple-600'],
                ];
                @endphp

                @foreach($results as $res)
                    {{-- Container Card Skor --}}
                    <div class="relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                        {{-- Gradient Bar Kiri --}}
                        @if($res['color'] == 'indigo')
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-indigo-400 via-indigo-500 to-indigo-600"></div>
                        @elseif($res['color'] == 'blue')
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-blue-400 via-blue-500 to-blue-600"></div>
                        @else
                            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-purple-400 via-purple-500 to-purple-600"></div>
                        @endif
                            
                        <div class="flex justify-between items-center p-6 pl-10">
                            <div class="flex-1">
                                <p class="text-xl font-bold text-gray-900 mb-1">{{ $res['label'] }}</p>
                                <p class="text-sm text-gray-500">Rentang Skor: 0-84</p>
                            </div> 
                            
                            {{-- SOLUSI SIMETRIS: Fixed Width Container --}}
                            <div class="flex items-center gap-4">
                                {{-- Card Angka Skor - Fixed Size --}}
                                @if($res['color'] == 'indigo')
                                    <div class="flex flex-col items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl shadow-lg">
                                        <span class="text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-indigo-100 mt-1">Skor</span>
                                    </div>
                                @elseif($res['color'] == 'blue')
                                    <div class="flex flex-col items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg">
                                        <span class="text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-blue-100 mt-1">Skor</span>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg">
                                        <span class="text-4xl font-extrabold text-white leading-none">{{ $res['score'] }}</span>
                                        <span class="text-xs text-purple-100 mt-1">Skor</span>
                                    </div>
                                @endif
                                
                                {{-- Badge Kategori - Fixed Width untuk Simetris --}}
                                <div class="w-36 flex justify-center">
                                    <span class="px-4 py-2 rounded-full text-sm font-bold inline-flex items-center justify-center whitespace-nowrap shadow-md
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
            <section class="mt-12 p-8 bg-gradient-to-br from-indigo-50 to-purple-50 border-l-4 border-indigo-600 rounded-2xl shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    {{-- Icon Lightbulb/Idea --}}
                    <svg class="w-7 h-7 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Rekomendasi Tindak Lanjut
                </h2>
                @php
                    // Logika rekomendasi dari skor tertinggi
                    $maxScore = max(
                        $participant->result->score_depression, 
                        $participant->result->score_anxiety, 
                        $participant->result->score_stress
                    );
                    
                    if ($maxScore <= 13) { // Normal - Ringan
                        $recommendationText = "Kondisi emosional Anda stabil atau dalam kategori Ringan. Pertahankan rutinitas sehat seperti tidur cukup, olahraga teratur, dan koneksi sosial. Deteksi dini berhasil!";
                    } elseif ($maxScore <= 25) { // Sedang
                        $recommendationText = "Skor Anda berada di kategori Sedang. Ini saatnya untuk mulai mencari bantuan mandiri: pelajari teknik relaksasi, manajemen stres, dan pertimbangkan berbicara dengan orang terpercaya.";
                    } else { // Berat - Sangat Berat
                        $recommendationText = "Skor Anda berada di kategori Berat/Sangat Berat. Kami sangat menganjurkan Anda untuk segera mencari bantuan profesional (Psikolog/Psikiater) untuk evaluasi dan penanganan lebih lanjut. Hasil tes ini dapat digunakan sebagai bahan konsultasi.";
                    }
                @endphp
                <div class="bg-white/80 p-6 rounded-xl">
                    <p class="text-gray-700 leading-relaxed font-medium">{{ $recommendationText }}</p>
                </div>
            </section>
            
            <!-- Detail Answers Section -->
            <section class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    Detail Jawaban
                </h2>
                <div class="bg-white overflow-hidden shadow-md rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="py-4 pl-6 pr-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No.</th>
                                <th class="px-3 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pertanyaan</th>
                                <th class="px-3 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-3 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Skor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($responses as $response)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-semibold text-gray-900">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full">
                                        {{ $response->question->question_number }}
                                    </span>
                                </td>
                                <td class="px-3 py-4 text-sm text-gray-700 max-w-2xl">{{ $response->question->text }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-700">
                                        {{ $response->question->category->name }} ({{ $response->question->category->code }})
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-indigo-600 text-white font-bold rounded-lg shadow">
                                        {{ $response->score }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="text-gray-700 font-medium mb-2">Terima kasih telah berpartisipasi dalam Tes PsyCheck DASS-42</p>
                <p class="text-sm text-gray-500">Hasil ini disajikan untuk tujuan skrining dan bukan diagnosis klinis</p>
                <a href="{{ route('landing') }}" class="inline-flex items-center px-6 py-3 mt-10 bg-indigo-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>
            </footer>
        </div>
    </div>
</main>
@endsection