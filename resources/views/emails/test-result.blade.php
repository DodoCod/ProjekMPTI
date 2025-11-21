@component('mail::message')
# Hasil Tes Kesehatan Mental Anda (DASS-42)

Halo **{{ $name }}**,

Berikut adalah ringkasan skor DASS-42 Anda, berdasarkan tes yang Anda selesaikan pada {{ \Carbon\Carbon::parse($participant->date_of_test)->format('d F Y') }}.

@component('mail::panel')
**Depresi:** {{ $result->score_depression }} (Kategori: {{ $result->category_depression }})

**Kecemasan (Anxiety):** {{ $result->score_anxiety }} (Kategori: {{ $result->category_anxiety }})

**Stres:** {{ $result->score_stress }} (Kategori: {{ $result->category_stress }})
@endcomponent

Hasil ini bersifat **skrining** dan bukan merupakan diagnosis klinis.

Jika Anda mendapatkan skor tinggi (Sedang/Berat/Sangat Berat), kami sangat menyarankan Anda untuk mencari bantuan profesional (psikolog/psikiater) untuk evaluasi yang lebih mendalam.

@component('mail::button', ['url' => config('app.url')])
Kembali ke PsyCheck
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent