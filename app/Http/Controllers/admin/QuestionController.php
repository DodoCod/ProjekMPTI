<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    /**
     * Menampilkan daftar semua pertanyaan (Soal) dengan paginasi.
     */
    public function index()
    {
        $questions = Question::with('category')->orderBy('question_number', 'asc')->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Menampilkan formulir untuk membuat pertanyaan baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.questions.create', compact('categories'));
    }

    /**
     * Menyimpan pertanyaan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_number' => 'required|integer|unique:questions,question_number',
            'text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    /**
     * Menampilkan formulir edit pertanyaan.
     */
    public function edit(Question $question)
    {
        $categories = Category::all();
        return view('admin.questions.edit', compact('question', 'categories'));
    }
    
    /**
     * Memperbarui pertanyaan di database.
     */
    public function update(Request $request, Question $question)
    {
        // Pengecekan unik pada question_number diabaikan jika ID-nya sama
        $request->validate([
            'question_number' => 'required|integer|unique:questions,question_number,' . $question->id,
            'text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Pertanyaan berhasil diperbarui!');
    }

    /**
     * Menghapus pertanyaan dari database.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
                         ->with('success', 'Pernyataan berhasil dihapus.');
    }
}