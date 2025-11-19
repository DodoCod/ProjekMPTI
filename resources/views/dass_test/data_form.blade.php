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

            <form action="{{ route('dass.data.store') }}" method="POST" class="space-y-6">
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
                        name="birth_date" {{-- Diubah menjadi 'birth_date' agar sesuai dengan nama kolom migrasi kita --}}
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
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
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

                <p class="text-sm text-center text-gray-500 pt-2">
                    Tes DASS-42 ini akan memakan waktu sekitar 10 menit.
                </p>

                <button 
                    type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 transform hover:scale-[1.01]"
                >
                    Lanjut ke Tes
                </button>
            </form>
        </div>
    </div>
</main>
@endsection