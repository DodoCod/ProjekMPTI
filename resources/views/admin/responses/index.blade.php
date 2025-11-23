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
                        
                        @if ($participant->result)
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-indigo-700">{{ $participant->result->score_depression }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-blue-700">{{ $participant->result->score_anxiety }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-purple-700">{{ $participant->result->score_stress }}</td>
                        @else
                            <td colspan="3" class="px-4 py-4 text-center text-sm text-red-500">Hasil belum tersedia</td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">                                
                                <a href="{{ route('admin.responses.show', $participant->unique_code) }}" 
                                   title="Lihat Detail"
                                   class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>

                                <button 
                                    type="button"
                                    onclick="showDeleteModal('{{ $participant->unique_code }}', '{{ addslashes($participant->name) }}')"
                                    title="Hapus"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg transition">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>

                                <form id="delete-form-{{ $participant->unique_code }}"
                                      action="{{ route('admin.responses.destroy', $participant->unique_code) }}"
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

@if ($participants->hasPages())
<div class="mt-6 w-full">
    <div class="flex items-center justify-between">
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

        <nav class="flex items-center space-x-2">
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="deleteModalContent" class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all duration-300 scale-95">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-orange-100 mb-4">
                <i data-lucide="alert-triangle" class="w-10 h-10 text-orange-600"></i>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Hapus Participant?</h3>
            
            <p class="text-gray-600 m-8">
                Apakah Anda yakin ingin menghapus respon dari 
                <span class="text-sm italic text-gray-500 mb-8" id="participantPreview">
                    Nama Peserta
                </span> ?
            </p>

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
    let deleteParticipantCode = null;

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    function showDeleteModal(uniqueCode, participantName) {
        deleteParticipantCode = uniqueCode;
        
        const preview = document.getElementById('participantPreview');
        const truncated = participantName.length > 100 ? participantName.substring(0, 100) + '...' : participantName;
        preview.textContent = truncated;
        
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
            deleteParticipantCode = null;
        }, 300);
    }

    function confirmDelete() {
        if (deleteParticipantCode) {
            const btn = document.getElementById('confirmDeleteBtn');
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menghapus...';
            
            document.getElementById('delete-form-' + deleteParticipantCode).submit();
        }
    }

    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
            closeDeleteModal();
        }
    });
</script>

@endsection