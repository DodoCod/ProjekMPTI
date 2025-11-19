@extends('layouts.app')

@section('content')
<main class="min-h-screen pt-32 pb-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white px-8 py-10 md:px-12 md:py-12 rounded-xl shadow-2xl shadow-indigo-300/40 border border-indigo-100">

            <header class="mb-4 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-indigo-800 mb-2">
                    Langkah 2: Tes DASS-42
                </h1>
                <p class="text-gray-600">
                    Jawab pertanyaan ini sesuai kondisi Anda <span class="font-semibold text-indigo-700">selama satu minggu terakhir</span>.
                </p>
            </header>

            <div class="mb-8">
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

            <form action="{{ route('dass.test.submit.step') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
                <input type="hidden" name="step" value="{{ $step }}">

                <div class="bg-gray-50 p-6 md:p-8 rounded-xl shadow-inner border border-gray-100"> 
                    
                    <p class="text-lg font-semibold text-indigo-700 mb-4 border-b border-gray-200 pb-2">
                        Item Tes {{ $currentQuestion->question_number }}
                    </p>
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 leading-snug">
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

                <div class="flex justify-between items-center pt-6">
                    @if ($step > 1)
                        <a href="{{ route('dass.test.start', ['step' => $step - 1]) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold flex items-center transition duration-150 cursor-pointer">
                            <i data-lucide="chevron-left" class="w-6 h-6 mr-1"></i>
                            Kembali
                        </a>
                    @else
                        <span class="text-gray-400 font-semibold flex items-center">
                            <i data-lucide="chevron-left" class="w-6 h-6 mr-1"></i>
                            Kembali
                        </span>
                    @endif
                    
                    {{-- PERBAIKAN: Semua button submit ke submit.step, tidak ada formaction --}}
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
@endsection