<div class="space-y-6">
    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Detail Item</h3>

        {{-- Nomor Item --}}
        <div>
            <label for="question_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Item DASS-42 <span class="text-red-500">*</span></label>
            <input 
                type="number" 
                name="question_number" 
                id="question_number" 
                value="{{ old('question_number', $question->question_number ?? '') }}"
                required 
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('question_number') border-red-500 @enderror"
                placeholder="Contoh: 1, 15, 42"
            >
            @error('question_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mt-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
            <select 
                name="category_id" 
                id="category_id" 
                required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror"
            >
                <option value="" disabled selected>Pilih Kategori (Depresi/Anxiety/Stress)</option>
                @foreach($categories as $category)
                    <option 
                        value="{{ $category->id }}"
                        @if(isset($question) && $question->category_id == $category->id) selected @endif
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }} ({{ $category->code }})
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Pernyataan --}}
        <div class="mt-4">
            <label for="text" class="block text-sm font-medium text-gray-700 mb-1">Teks Pernyataan <span class="text-red-500">*</span></label>
            <textarea 
                name="text" 
                id="text" 
                rows="4"
                required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('text') border-red-500 @enderror"
                placeholder="Masukkan teks lengkap pertanyaan DASS-42"
            >{{ old('text', $question->text ?? '') }}</textarea>
            @error('text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="pt-4 flex justify-end space-x-3">
        <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition duration-150">
            Batal
        </a>
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition duration-150 shadow-md">
            {{ isset($question) ? 'Simpan Perubahan' : 'Tambahkan Pertanyaan' }}
        </button>
    </div>
</div>