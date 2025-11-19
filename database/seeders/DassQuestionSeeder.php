<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class DassQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public
    function run(): void
    {
        // 1. Dapatkan ID dari Kategori yang sudah ada
        $categories = Category::pluck('id', 'name')->toArray();

        // 2. Data Pertanyaan DASS-42 (Item Number, Category Name, Statement)
        $questions_raw = [
            [1, 'Stress', 'Saya merasa sulit untuk bersantai.'],
            [2, 'Anxiety', 'Saya menyadari mulut saya kering.'],
            [3, 'Depression', 'Saya sama sekali tidak dapat merasakan perasaan positif.'],
            [4, 'Anxiety', 'Saya mengalami kesulitan bernapas (misalnya: seringkali terengah-engah atau tidak dapat bernapas padahal tidak melakukan aktivitas fisik sebelumnya).'],
            [5, 'Depression', 'Saya merasa sedikit pun tidak kuat untuk melakukan suatu kegiatan.'],
            [6, 'Stress', 'Saya cenderung bereaksi berlebihan terhadap suatu situasi.'],
            [7, 'Anxiety', 'Saya gemetar (misalnya di tangan).'],
            [8, 'Stress', 'Saya merasa banyak mengeluarkan energi saraf.'],
            [9, 'Anxiety', 'Saya khawatir tentang situasi di mana saya mungkin panik dan membuat diri saya bodoh.'],
            [10, 'Depression', 'Saya merasa tidak ada hal yang dapat saya nantikan.'],
            [11, 'Stress', 'Saya merasa sulit untuk bersemangat dalam melakukan sesuatu.'],
            [12, 'Stress', 'Saya merasa tidak sabar dengan gangguan.'],
            [13, 'Depression', 'Saya merasa sedih dan tertekan.'],
            [14, 'Stress', 'Saya merasa bahwa saya terlalu sensitif.'],
            [15, 'Anxiety', 'Saya takut tanpa alasan yang jelas.'],
            [16, 'Depression', 'Saya merasa hidup saya tidak berarti.'],
            [17, 'Stress', 'Saya merasa tidak tahan dengan hal-hal yang menghalangi saya untuk mencapai tujuan saya.'],
            [18, 'Anxiety', 'Saya merasa dekat dengan kepanikan.'],
            [19, 'Depression', 'Saya tidak dapat menyajikan inisiatif apa pun untuk menghadapi suatu situasi.'],
            [20, 'Anxiety', 'Saya berkeringat (misalnya tangan berkeringat) meskipun tidak ada panas atau aktivitas fisik.'],
            [21, 'Stress', 'Saya tidak bisa tenang saat ada hal yang harus dikerjakan.'],
            [22, 'Depression', 'Saya tidak merasakan apa-apa dari pengalaman yang biasanya membuat saya senang.'],
            [23, 'Stress', 'Saya merasa tegang.'],
            [24, 'Depression', 'Saya kehilangan minat pada hampir segala hal.'],
            [25, 'Anxiety', 'Saya merasa seperti saya agak takut.'],
            [26, 'Depression', 'Saya merasa tidak berharga sebagai pribadi.'],
            [27, 'Stress', 'Saya mudah tersinggung.'],
            [28, 'Anxiety', 'Saya khawatir tentang kemungkinan terjadinya situasi di mana saya akan menjadi malu.'],
            [29, 'Depression', 'Saya merasa bahwa hidup ini tidak berguna.'],
            [30, 'Stress', 'Saya merasa sangat gelisah.'],
            [31, 'Depression', 'Saya menemukan diri saya mudah menangis.'],
            [32, 'Anxiety', 'Saya tidak bisa mentolerir gangguan apa pun dalam mencapai tujuan saya.'],
            [33, 'Depression', 'Saya merasa sedih.'],
            [34, 'Anxiety', 'Saya merasa panik.'],
            [35, 'Stress', 'Saya merasa sulit untuk bersantai setelah hari yang menegangkan.'],
            [36, 'Depression', 'Saya merasa bahwa saya memiliki sedikit nilai sebagai pribadi.'],
            [37, 'Anxiety', 'Saya khawatir bahwa saya mungkin berada di ambang pingsan.'],
            [38, 'Depression', 'Saya tidak dapat menikmati kegiatan apa pun yang saya lakukan.'],
            [39, 'Depression', 'Saya merasa putus asa.'],
            [40, 'Anxiety', 'Saya merasa gelisah.'],
            [41, 'Stress', 'Saya merasa kesulitan untuk tertidur.'],
            [42, 'Anxiety', 'Saya merasa detak jantung saya cepat atau tidak teratur (tanpa melakukan aktivitas fisik).'],
        ];

        $questions_to_insert = [];

        foreach ($questions_raw as $q) {
            $categoryName = $q[1];
            
            if (!isset($categories[$categoryName])) {
                // Jika kategori tidak ditemukan, lewati item ini atau berikan peringatan
                continue; 
            }

            $questions_to_insert[] = [
                'question_number' => $q[0],
                'category_id' => $categories[$categoryName], // Menggunakan FK ID
                'text' => $q[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Masukkan data hanya jika tabel masih kosong
        if (DB::table('questions')->count() === 0) {
            DB::table('questions')->insert($questions_to_insert);
        }
    }
}