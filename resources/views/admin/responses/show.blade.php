@extends('layouts.admin')

@section('title', 'Detail Respon Peserta')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-indigo-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold text-white">Detail Hasil Tes DASS-42</h1>
                            <p class="text-blue-100 text-sm mt-1">Informasi lengkap peserta dan hasil tes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Breadcrumb --}}
            <div class="px-8 py-4 bg-blue-50 border-b border-blue-100">
                <a href="{{ route('admin.responses.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Respon
                </a>
            </div>
        </div>

        {{-- Info Peserta --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Informasi Peserta
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Nama --}}
                <div class="flex items-center space-x-3 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
                    <div class="flex-shrink-0 w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Nama Lengkap</p>
                        <p class="text-sm font-bold text-gray-900">{{ $participant->name }}</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs text-gray-500 font-medium">Email</p>
                        <p class="text-sm font-bold text-gray-900 truncate">{{ $participant->email ?? '-' }}</p>
                    </div>
                </div>

                {{-- Usia --}}
                <div class="flex items-center space-x-3 p-4 bg-purple-50 rounded-xl border border-purple-100">
                    <div class="flex-shrink-0 w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">{{ $participant->age }}</span>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Usia</p>
                        <p class="text-sm font-bold text-gray-900">{{ $participant->age }} tahun</p>
                    </div>
                </div>

                {{-- Tanggal Tes --}}
                <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-xl border border-green-100">
                    <div class="flex-shrink-0 w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Tanggal Tes</p>
                        <p class="text-sm font-bold text-gray-900">{{ $participant->date_of_test->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Hasil Skor DASS-42 --}}
        @if($participant->result)
            <section class="mb-10 space-y-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
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
                            
                            <div class="flex items-center gap-4">
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
            @endif
            
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
                        @foreach($participant->responses()->with('question.category')->orderBy('question_id')->get() as $response)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-semibold text-gray-900">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-700 rounded-full">
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
                                    <span class="inline-flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 font-bold rounded-lg shadow">
                                        {{ $response->score }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

        {{-- Action Buttons --}}
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('admin.responses.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-all duration-200 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>

            <form action="{{ route('admin.responses.destroy', $participant->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peserta ini? Semua jawaban akan hilang.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Data Peserta
                </button>
            </form>
        </div>
    </div>
</div>
@endsection