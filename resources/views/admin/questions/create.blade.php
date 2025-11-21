@extends('layouts.admin')

@section('title', 'Tambah Pertanyaan')

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
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Header Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden mb-6 transform transition-all duration-300 hover:shadow-2xl">
            <div class="bg-indigo-600 px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-white">Tambah Pernyataan Baru</h1>
                        <p class="text-blue-100 text-sm mt-1">Lengkapi form untuk menambahkan pertanyaan</p>
                    </div>
                </div>
            </div>
            
            {{-- Breadcrumb Navigation --}}
            <div class="px-8 py-4 bg-blue-50 border-b border-blue-100">
                <a href="{{ route('admin.questions.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Soal
                </a>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
            <form action="{{ route('admin.questions.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                {{-- Grid Layout untuk Form --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    {{-- Input Nomor Pertanyaan --}}
                    <div class="lg:col-span-1">
                        <label for="question_number" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            Nomor Soal
                        </label>
                        <div class="relative">
                            <input 
                                id="question_number" 
                                name="question_number" 
                                type="number" 
                                required
                                value="{{ old('question_number') }}" 
                                placeholder="Contoh: 1"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder:text-gray-400 focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500 transition-all duration-200 hover:border-blue-300"
                                min="1"
                            >
                        </div>
                        @error('question_number')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        {{-- Info Helper --}}
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-1 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Urutan pertanyaan dalam kuesioner
                            </p>
                        </div>
                    </div>

                    {{-- Dropdown Kategori --}}
                    <div class="lg:col-span-2">
                        <label for="category_id" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                            Kategori (DASS)
                        </label>
                        <div class="relative">
                            <select 
                                id="category_id" 
                                name="category_id" 
                                required
                                class="block w-full px-4 py-3 pr-10 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500 hover:border-blue-300 transition-all duration-200 appearance-none bg-white"
                            >
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option 
                                        value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <div class="mt-2 flex items-center text-sm text-red-600">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        {{-- Info Helper --}}
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-1 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Pilih Depresi, Kecemasan, atau Stres
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Input Teks Pertanyaan --}}
                <div>
                    <label for="text" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                        </svg>
                        Teks Pertanyaan / Pernyataan
                    </label>
                    <div class="relative">
                        <textarea 
                            id="text" 
                            name="text" 
                            rows="5" 
                            required
                            placeholder="Contoh: Saya merasa sulit untuk tenang setelah sesuatu yang mengganggu saya..."
                            class="block w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm placeholder:text-gray-400 focus:outline-none hover:border-grey-300 transition-all duration-200 resize-none"
                        >{{ old('text') }}</textarea>
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    @error('text')
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-1 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                    
                    {{-- Info Helper --}}
                    <div class="mt-2">
                        <p class="text-xs text-gray-500 flex items-start">
                            <svg class="w-4 h-4 mr-1 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Tuliskan pernyataan yang jelas dan mudah dipahami oleh responden
                        </p>
                    </div>
                </div>

                {{-- Preview Section --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-start space-x-3">
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-blue-800 mb-1 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Pratinjau Skala Jawaban
                            </h3>
                            <p class="text-sm text-blue-700">
                                Pertanyaan akan muncul dengan skala jawaban:
                                <strong class="text-indigo-600">0</strong> Tidak Pernah,
                                <strong class="text-indigo-600">1</strong> Kadang-kadang,
                                <strong class="text-indigo-600">2</strong> Sering,
                                <strong class="text-indigo-600">3</strong> Sangat Sering
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.questions.index') }}" 
                       class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:border-gray-400 hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 hover:bg-indigo-700 hover:shadow-lg hover:border-indigo-900">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Pertanyaan
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Card di bawah --}}
        <div class="mt-6 bg-white border border-blue-100 shadow-md rounded-xl p-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1 2a1 1 0 00-1 1v3a1 1 0 002 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                Informasi Penting
            </h3>
            <ul class="text-xs text-gray-600 space-y-2 ml-4 list-none">
                <li class="flex items-start">
                    <span class="text-blue-600 mr-2 font-bold">•</span>
                    <span>Total DASS-42 terdiri dari 42 pertanyaan (14 pertanyaan untuk setiap kategori)</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-600 mr-2 font-bold">•</span>
                    <span>Pastikan <strong>Nomor Soal</strong> tidak duplikat dengan yang sudah ada di database</span>
                </li>
                <li class="flex items-start">
                    <span class="text-blue-600 mr-2 font-bold">•</span>
                    <span>Gunakan kalimat yang jelas dan mudah dipahami, sesuai dengan format DASS-42 standar</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection