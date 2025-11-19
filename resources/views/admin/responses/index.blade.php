@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-2">Data Respon Tes Kesehatan Mental Gratis</h1>
<p class="text-gray-600 mb-6">Halaman ini menyajikan setiap responden yang telah mengikuti tes DASS-42.</p>

<div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-gray-200">
    @if ($participants->isEmpty())
        <div class="p-4 text-center text-sm text-gray-500">
            Belum ada responden yang mengikuti tes DASS-42.
        </div>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="pl-8 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Ujian</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Depresi</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Anxiety</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stres</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($participants as $index => $participant)
                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                        <td class="pl-8 px-6 py-4 text-sm text-gray-900">{{ $participants->firstItem() + $index }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $participant->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $participant->email ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $participant->date_of_test->format('Y-m-d H:i') }}</td>
                        
                        {{-- Skor Akhir --}}
                        @if ($participant->result)
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-indigo-700">{{ $participant->result->score_depression }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-blue-700">{{ $participant->result->score_anxiety }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-purple-700">{{ $participant->result->score_stress }}</td>
                        @else
                            <td colspan="3" class="px-4 py-4 text-center text-sm text-red-500">Hasil belum tersedia</td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">                                
                                <a href="{{ route('admin.responses.show', $participant->id) }}" 
                                   title="Lihat Detail"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.responses.destroy', $participant->id) }}" 
                                      method="POST" 
                                      class="inline-block" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peserta ini? Semua jawaban akan hilang.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            title="Hapus"
                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- Custom Pagination --}}
@if ($participants->hasPages())
<div class="mt-6 w-full">
    <div class="flex items-center justify-between">

        {{-- Informasi posisi data --}}
        @php
            $currentPage = $participants->currentPage();
            $perPage = $participants->perPage();
            $total = $participants->total();
            $from = ($currentPage - 1) * $perPage + 1;
            $to = min($currentPage * $perPage, $total);
        @endphp

        <p class="text-sm text-gray-600">
            Menampilkan <span class="font-semibold">{{ $from }}</span> –
            <span class="font-semibold">{{ $to }}</span> dari
            <span class="font-semibold">{{ $total }}</span> data
        </p>

        {{-- Pagination Buttons --}}
        <nav class="flex items-center space-x-2">

            {{-- Previous --}}
            @if ($participants->onFirstPage())
                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </span>
            @else
                <a href="{{ $participants->previousPageUrl() }}"
                    class="px-3 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($participants->getUrlRange(1, $participants->lastPage()) as $page => $url)
                @if ($page == $participants->currentPage())
                    <span class="px-4 py-2 text-white bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg font-semibold shadow">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                        class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition text-gray-700">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($participants->hasMorePages())
                <a href="{{ $participants->nextPageUrl() }}"
                    class="px-3 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </span>
            @endif

        </nav>
    </div>
</div>
@endif

@endsection