@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-2">Data Soal Tes Kesehatan Mental Gratis</h1>
<p class="text-gray-600 mb-6">Halaman ini menunjukkan setiap pernyataan yang digunakan dalam tes DASS-42.</p>

<div class="flex justify-between items-center mb-4">
    <a href="{{ route('admin.questions.create') }}"
       class="inline-flex items-center px-5 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition duration-150 shadow-md">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Pernyataan
    </a>
</div>

<div class="bg-white shadow-xl rounded-xl overflow-x-auto border border-gray-200">
    @if ($questions->isEmpty())
        <div class="p-6 text-center text-gray-500">
            Belum ada pertanyaan DASS-42 yang terdaftar.
        </div>
    @else
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="pl-8 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-36">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pernyataan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($questions as $question)
                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                        <td class="pl-8 px-6 py-4 text-sm text-gray-700">{{ $question->question_number }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $question->category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xl whitespace-normal">{{ $question->text }}</td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.questions.edit', $question->id) }}"
                                   title="Edit"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 rounded-lg transition">
                                    <i data-lucide="square-pen" class="w-4 h-4"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.questions.destroy', $question->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="Hapus"
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
@if ($questions->hasPages())
<div class="mt-6 w-full">
    <div class="flex items-center justify-between">

        {{-- Informasi posisi data --}}
        @php
            $currentPage = $questions->currentPage();
            $perPage = $questions->perPage();
            $total = $questions->total();
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
            @if ($questions->onFirstPage())
                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </span>
            @else
                <a href="{{ $questions->previousPageUrl() }}"
                    class="px-3 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($questions->getUrlRange(1, $questions->lastPage()) as $page => $url)
                @if ($page == $questions->currentPage())
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
            @if ($questions->hasMorePages())
                <a href="{{ $questions->nextPageUrl() }}"
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
