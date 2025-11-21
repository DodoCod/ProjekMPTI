@extends('layouts.admin')

@section('content')

<h1 class="text-3xl mb-6 font-bold text-gray-800">Data Soal Tes Kesehatan Mental</h1>

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
                                <button 
                                    type="button"
                                    onclick="showDeleteModal({{ $question->id }}, '{{ addslashes($question->text) }}')"
                                    title="Hapus"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>

                                {{-- Hidden Form for Delete --}}
                                <form id="delete-form-{{ $question->id }}"
                                      action="{{ route('admin.questions.destroy', $question->id) }}"
                                      method="POST"
                                      class="hidden">
                                    @csrf
                                    @method('DELETE')
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
                    <span class="px-4 py-2 text-white bg-indigo-600 rounded-lg font-semibold shadow">
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="deleteModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all duration-300 scale-95">
        <div class="text-center">
            <!-- Icon Warning -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-orange-100 mb-4">
                <i data-lucide="alert-triangle" class="w-10 h-10 text-orange-600"></i>
            </div>
            
            <!-- Title -->
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Hapus Pertanyaan?</h3>
            
            <!-- Description -->
            <p class="text-gray-600 mb-2">
                Apakah Anda yakin ingin menghapus pertanyaan ini?
            </p>
            <p class="text-sm text-gray-500 italic mb-6" id="questionPreview">
                "Pertanyaan akan ditampilkan di sini"
            </p>
            
            <!-- Warning Box -->
            <div class="bg-orange-50 border-l-4 border-orange-400 p-4 mb-6 text-left rounded-lg">
                <div class="flex items-start">
                    <i data-lucide="info" class="w-5 h-5 text-orange-600 mt-0.5 mr-3 flex-shrink-0"></i>
                    <div class="text-sm text-orange-800">
                        <p class="font-semibold mb-1">Perhatian:</p>
                        <ul class="space-y-1 ml-4 list-disc text-xs">
                            <li>Data yang dihapus tidak dapat dikembalikan</li>
                            <li>Pastikan Anda yakin sebelum melanjutkan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button 
                    type="button"
                    onclick="closeDeleteModal()"
                    class="flex-1 px-6 py-3 border-2 border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition"
                >
                    Batal
                </button>
                <button 
                    type="button"
                    onclick="confirmDelete()"
                    class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition shadow-md flex items-center justify-center"
                    id="confirmDeleteBtn"
                >
                    <i data-lucide="trash-2" class="w-5 h-5 mr-2"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let deleteQuestionId = null;

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    function showDeleteModal(questionId, questionText) {
        deleteQuestionId = questionId;
        
        // Update question preview
        const preview = document.getElementById('questionPreview');
        const truncated = questionText.length > 100 ? questionText.substring(0, 100) + '...' : questionText;
        preview.textContent = `"${truncated}"`;
        
        // Show modal with animation
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modal.classList.remove('hidden');
        lucide.createIcons();
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            deleteQuestionId = null;
        }, 300);
    }

    function confirmDelete() {
        if (deleteQuestionId) {
            // Show loading state
            const btn = document.getElementById('confirmDeleteBtn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
            
            // Submit the form
            document.getElementById('delete-form-' + deleteQuestionId).submit();
        }
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
            closeDeleteModal();
        }
    });
</script>

@endsection