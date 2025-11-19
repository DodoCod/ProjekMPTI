<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->unique()->constrained('participants')->onDelete('cascade');
            $table->unsignedSmallInteger('score_depression'); // Skor Depresi
            $table->unsignedSmallInteger('score_anxiety'); // Skor Anxiety
            $table->unsignedSmallInteger('score_stress'); // Skor Stress
            
            // Opsional: Kolom untuk interpretasi kategori teks (misal: "Berat")
            $table->string('category_depression', 50)->nullable();
            $table->string('category_anxiety', 50)->nullable();
            $table->string('category_stress', 50)->nullable();

            $table->text('admin_feedback')->nullable(); // Kolom untuk Feedback/Catatan Admin (terlihat di detail)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
