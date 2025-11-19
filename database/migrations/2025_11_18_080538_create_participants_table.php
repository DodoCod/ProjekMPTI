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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Lengkap
            $table->string('email')->nullable(); // Email
            $table->unsignedSmallInteger('age')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan', 'Lainnya'])->nullable(); // Jenis Kelamin
            $table->date('date_of_birth')->nullable(); // Tanggal Lahir (BARU)
            $table->timestamp('date_of_test')->useCurrent(); // Tanggal Ujian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
