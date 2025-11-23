@extends('layouts.app') 

@section('content')
<main class="min-h-screen pt-20 pb-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg border-t-4 border-indigo-600">
            <header class="mb-8 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-indigo-700 mb-2">
                    Langkah 1: Data Diri Awal
                </h1>
                <p class="text-gray-600">
                    Mohon isi data singkat di bawah untuk memulai tes. <span class="font-semibold">Data Anda terjamin kerahasiaannya.</span>
                </p>
            </header>

            {{-- Timer Notice Banner --}}
            <div class="mb-6 bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 p-5 rounded-lg shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i data-lucide="clock" class="w-6 h-6 text-amber-600"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-base font-bold text-amber-900 mb-1">
                            ⏰ Perhatian: Batas Waktu Pengerjaan
                        </h3>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Setelah Anda memulai tes, <span class="font-bold">Anda memiliki waktu 10 menit</span> untuk menyelesaikan seluruh pertanyaan ini. 
                            Timer akan dimulai otomatis saat Anda masuk ke halaman pertanyaan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Important Instructions Card --}}
            <div class="mb-6 bg-indigo-50 border border-indigo-200 rounded-lg p-5">
                <h3 class="text-base font-bold text-indigo-900 mb-3 flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-2 text-indigo-600"></i>
                    Hal Penting Sebelum Memulai
                </h3>
                <ul class="space-y-2 text-sm text-indigo-800">
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2 mt-0.5">✓</span>
                        <span>Pastikan Anda berada di <strong>tempat yang tenang</strong> tanpa gangguan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2 mt-0.5">✓</span>
                        <span>Siapkan <strong>koneksi internet yang stabil</strong> selama pengerjaan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2 mt-0.5">✓</span>
                        <span>Jawab semua pertanyaan dengan <strong>jujur</strong> sesuai kondisi Anda dalam 1 minggu terakhir</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-indigo-600 mr-2 mt-0.5">✓</span>
                        <span>Jika waktu habis, jawaban Anda akan <strong>tersimpan otomatis</strong></span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-amber-600 mr-2 mt-0.5">⚠️</span>
                        <span><strong>Timer tidak akan berhenti</strong> meskipun Anda me-refresh halaman</span>
                    </li>
                </ul>
            </div>

            <form action="{{ route('dass.data.store') }}" method="POST" class="space-y-6" id="dataForm">
                @csrf
                
                {{-- Nama Lengkap (WAJIB) --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}"
                        required 
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama Anda"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Lahir (WAJIB) --}}
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input 
                        type="date" 
                        name="birth_date"
                        id="birth_date" 
                        value="{{ old('birth_date') }}"
                        required 
                        max="{{ now()->subYears(5)->format('Y-m-d') }}"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('birth_date') border-red-500 @enderror"
                    >
                    @error('birth_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Jenis Kelamin (WAJIB) --}}
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select 
                        name="gender" 
                        id="gender" 
                        required
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('gender') border-red-500 @enderror"
                    >
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        <option value="Lainnya" {{ old('gender') == 'Lainnya' ? 'selected' : '' }}>Lainnya/Tidak Ingin Disebutkan</option>
                    </select>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Email (Opsional) --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                        required
                        placeholder="Alamat email Anda"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmation Checkbox --}}
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="flex items-start cursor-pointer">
                        <input 
                            type="checkbox" 
                            id="confirmReady" 
                            required
                            class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mt-0.5"
                        >
                        <span class="ml-3 text-sm text-gray-700">
                            Saya memahami bahwa tes ini memiliki <strong>batas waktu 10 menit</strong> dan saya siap untuk mengerjakan dengan fokus tanpa gangguan.
                        </span>
                    </label>
                </div>

                <button 
                    type="button"
                    onclick="showConfirmationModal()"
                    class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 transform hover:scale-[1.01] cursor-pointer"
                >
                    <i data-lucide="play-circle" class="w-5 h-5 mr-2"></i>
                    Mulai Tes Sekarang
                </button>

                <p class="text-xs text-center text-gray-500 pt-2">
                    Dengan melanjutkan, Anda menyetujui bahwa data yang Anda berikan akan digunakan untuk keperluan asesmen kesehatan mental.
                </p>
            </form>
        </div>
    </div>
</main>

{{-- Confirmation Modal --}}
<div id="confirmationModal" class="hidden fixed inset-0 bg-black/30 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
    <div id="confirmationModalContent" class="bg-white rounded-2xl shadow-2xl max-w-lg w-full p-8 transform transition-all duration-300 scale-95">
        <div class="text-center mb-6">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-amber-100 mb-4">
                <i data-lucide="timer" class="w-10 h-10 text-amber-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Siap Memulai Tes?</h3>
            <p class="text-gray-600">
                Setelah Anda klik <strong>"Ya, Mulai Tes"</strong>, timer <strong>10 menit</strong> akan langsung dimulai dan tidak dapat dihentikan.
            </p>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0"></i>
                <div class="text-sm text-amber-900">
                    <p class="font-semibold mb-1">Pastikan:</p>
                    <ul class="space-y-1 ml-4 list-disc">
                        <li>Anda berada di tempat yang tenang</li>
                        <li>Koneksi internet stabil</li>
                        <li>Anda memiliki waktu 10 menit tanpa gangguan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-3">
            <button 
                type="button"
                onclick="closeConfirmationModal()"
                class="flex-1 px-6 py-3 border-2 border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition cursor-pointer"
            >
                Batal
            </button>
            <button 
                type="button"
                onclick="submitForm()"
                class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-md flex items-center justify-center cursor-pointer"
            >
                <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                Ya, Mulai Tes
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    function showConfirmationModal() {
        // Validate form first
        const form = document.getElementById('dataForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Check if confirmation checkbox is checked
        const confirmCheckbox = document.getElementById('confirmReady');
        if (!confirmCheckbox.checked) {
            alert('Mohon centang kotak konfirmasi bahwa Anda siap mengerjakan tes dengan batas waktu 10 menit.');
            confirmCheckbox.focus();
            return;
        }

        // Show modal with animation
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.getElementById('confirmationModalContent');
        
        modal.classList.remove('hidden');
        lucide.createIcons(); // Refresh icons in modal
        
        // Trigger animation after a small delay
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeConfirmationModal() {
        const modal = document.getElementById('confirmationModal');
        const modalContent = document.getElementById('confirmationModalContent');
        
        // Trigger close animation
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        // Hide modal after animation completes
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Match transition duration
    }

    function submitForm() {
        document.getElementById('dataForm').submit();
    }

    // Close modal when clicking outside
    document.getElementById('confirmationModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmationModal();
        }
    });
</script>
@endsection