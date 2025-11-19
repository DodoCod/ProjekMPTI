@extends('layouts.app')

@section('content')

    <nav class="fixed top-0 w-full z-50 transition-all duration-300 bg-white shadow-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">PsyCheck</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    @foreach(['Beranda', 'Tentang', 'Fitur'] as $item)
                        <button 
                            onclick="scrollToSection('{{ strtolower($item) }}')"
                            class="text-gray-700 hover:text-indigo-600 transition font-medium relative group"
                        >
                            {{ $item }}
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
                        </button>
                    @endforeach
                    <button 
                        onclick="scrollToSection('penilaian')"
                        class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium shadow-md hover:shadow-lg transform hover:scale-105"
                    >
                        Mulai Tes
                    </button>
                </div>

                <button 
                    id="menu-button"
                    class="md:hidden p-2 hover:bg-gray-100 rounded-lg transition"
                >
                    <i data-lucide="menu" id="menu-icon" class="w-6 h-6"></i>
                </button>
            </div>

            <div id="mobile-menu" class="md:hidden overflow-hidden transition-all duration-500 ease-in-out max-h-0 opacity-0">
                <div class="pb-4 space-y-1">
                    @foreach(['Beranda', 'Tentang', 'Fitur', 'Penilaian'] as $item)
                        <button 
                            onclick="scrollToSection('{{ strtolower($item) }}')"
                            class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition transform"
                        >
                            {{ $item }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-indigo-50/30 to-white transition-all duration-1000 opacity-0 translate-y-10">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-100 rounded-full text-indigo-700 font-medium text-sm animate-fadeIn">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        Platform Penilaian Kesehatan Mental Terpercaya
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight animate-fadeInUp">
                        Kenali Kesehatan Mental Anda dengan Lebih Baik
                    </h1>
                    
                    <p class="text-xl text-gray-600 leading-relaxed animate-fadeInUp" style="animation-delay: 0.2s;">
                        Ikuti tes DASS-42 yang telah tervalidasi secara ilmiah untuk mendapatkan wawasan tentang tingkat depresi, kecemasan, dan stres Anda. Profesional, rahasia, dan sepenuhnya gratis.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 animate-fadeInUp" style="animation-delay: 0.4s;">
                        <button 
                            onclick="scrollToSection('penilaian')"
                            class="group bg-indigo-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-indigo-700 transition flex items-center justify-center gap-2 shadow-lg shadow-indigo-600/30"
                        >
                            Mulai Penilaian
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        
                        <button 
                            onclick="scrollToSection('tentang')"
                            class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:border-indigo-600 hover:text-indigo-600 transition"
                        >
                            Pelajari Lebih Lanjut
                        </button>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-8 border-t border-gray-200">
                        @php
                            $stats = [
                                ["number" => "42", "label" => "Pertanyaan Tervalidasi"],
                                ["number" => "3", "label" => "Dimensi Emosional"],
                                ["number" => "10 menit", "label" => "Rata-rata Pengerjaan"],
                                ["number" => "100%", "label" => "Akses Gratis"]
                            ];
                        @endphp
                        @foreach($stats as $idx => $stat)
                            <div class="text-center animate-fadeInUp" style="animation-delay: {{ 0.6 + $idx * 0.1 }}s;">
                                <div class="text-3xl font-bold text-indigo-600 mb-1">
                                    {{ $stat['number'] }}
                                </div>
                                <div class="text-sm text-gray-600">{{ $stat['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative animate-fadeInUp" style="animation-delay: 0.3s;">
                    <div class="relative bg-gradient-to-br from-indigo-100 to-purple-100 rounded-3xl p-12 aspect-square flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="absolute w-full h-full border-2 border-indigo-300/30 rounded-full animate-ping" style="animation-duration: 3s;"></div>
                            <div class="absolute w-4/5 h-4/5 border-2 border-purple-300/30 rounded-full animate-pulse" style="animation-duration: 2s;"></div>
                            <div class="absolute w-3/5 h-3/5 border-2 border-blue-300/30 rounded-full animate-ping" style="animation-duration: 2.5s; animation-delay: 0.5s;"></div>
                        </div>
                        
                        <div class="absolute inset-0 bg-white/40 backdrop-blur-sm rounded-3xl"></div>
                        <i data-lucide="brain" class="w-48 h-48 text-indigo-600 relative z-10 animate-float" style="stroke-width: 1.5;"></i>
                        
                        <div class="absolute top-8 right-8 bg-white p-4 rounded-xl shadow-xl animate-floatDelay1">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">Tervalidasi</div>
                                    <div class="text-xs text-gray-600">Metode Ilmiah</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute bottom-8 left-8 bg-white p-4 rounded-xl shadow-xl animate-floatDelay2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i data-lucide="shield" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">Aman</div>
                                    <div class="text-xs text-gray-600">Data Terlindungi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50 transition-all duration-1000 opacity-0 translate-y-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full text-gray-700 font-medium text-sm mb-4 shadow-sm">
                    <i data-lucide="file-text" class="w-4 h-4 text-indigo-600"></i>
                    Alat Penilaian DASS-42
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Apa itu DASS-42?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Alat penilaian psikologis komprehensif yang dirancang untuk mengukur tiga dimensi kunci kesehatan mental
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                @php
                    $dimensions = [
                        [
                            "title" => "Depresi",
                            "desc" => "Mengukur gejala termasuk kehilangan minat, penurunan energi, dan perasaan sedih atau putus asa yang persisten.",
                            "color" => "indigo",
                            "icon" => "cloud-lightning" 
                        ],
                        [
                            "title" => "Kecemasan",
                            "desc" => "Menilai gejala kecemasan seperti ketegangan, kekhawatiran berlebihan, respons panik, dan gairah otonom.",
                            "color" => "blue",
                            "icon" => "alert-triangle" 
                        ],
                        [
                            "title" => "Stres",
                            "desc" => "Mengidentifikasi tingkat stres termasuk kesulitan relaksasi, mudah marah, tidak sabar, dan ketegangan saraf.",
                            "color" => "purple",
                            "icon" => "activity" 
                        ]
                    ];
                @endphp
                @foreach($dimensions as $item)
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition">
                        {{-- KODE YANG DIREVISI: Menggunakan Ikon Lucide --}}
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-{{ $item['color'] }}-100 rounded-xl mb-6">
                            <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6 text-{{ $item['color'] }}-600"></i>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $item['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="bg-white p-10 md:p-12 rounded-2xl shadow-sm border border-gray-100">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-6">
                            Mengapa DASS-42 Penting
                        </h3>
                        <div class="space-y-4 text-gray-600 leading-relaxed">
                            <p>
                                DASS-42 adalah instrumen laporan diri yang dirancang untuk mengukur tiga kondisi emosional negatif yang terkait: depresi, kecemasan, dan stres. Instrumen ini telah divalidasi secara ekstensif dan digunakan secara internasional untuk penyaringan kesehatan mental.
                            </p>
                            <p>
                                Dengan memahami kondisi emosional Anda saat ini, Anda dapat mengambil langkah proaktif untuk meningkatkan kesejahteraan mental dan mencari dukungan profesional ketika diperlukan.
                            </p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        @php
                            $points = [
                                "Penilaian yang diakui secara internasional",
                                "Tervalidasi di berbagai populasi",
                                "Digunakan oleh profesional kesehatan",
                                "Memberikan wawasan yang dapat ditindaklanjuti"
                            ];
                        @endphp
                        @foreach($points as $idx => $text)
                            <div class="flex items-start gap-3 p-4 bg-indigo-50 rounded-lg">
                                <div class="text-indigo-600 mt-0.5"><i data-lucide="check-circle" class="w-5 h-5"></i></div>
                                <span class="text-gray-700 font-medium">{{ $text }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-24 px-4 sm:px-6 lg:px-8 transition-all duration-1000 opacity-0 translate-y-10">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Mengapa Memilih Platform Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Alat penilaian tingkat profesional dengan keamanan tingkat perusahaan dan pengalaman pengguna terbaik
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $features = [
                        ["icon" => "brain", "title" => "Tervalidasi Secara Ilmiah", "description" => "Menggunakan instrumen DASS-42 yang telah divalidasi dan diakui secara internasional", "gradient" => "from-indigo-500 to-indigo-600"],
                        ["icon" => "shield", "title" => "Rahasia & Aman", "description" => "Privasi Anda adalah prioritas kami dengan enkripsi data tingkat perusahaan", "gradient" => "from-blue-500 to-blue-600"],
                        ["icon" => "clock", "title" => "Penilaian Cepat", "description" => "Selesaikan dalam 10 menit dan dapatkan hasil komprehensif secara instan", "gradient" => "from-violet-500 to-violet-600"],
                        ["icon" => "bar-chart-3", "title" => "Analisis Terperinci", "description" => "Laporan mendalam dengan skor terpisah untuk Depresi, Kecemasan, dan Stres", "gradient" => "from-purple-500 to-purple-600"]
                    ];
                @endphp
                @foreach($features as $feature)
                    <div 
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-indigo-200 transform hover:-translate-y-1"
                    >
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br {{ $feature['gradient'] }} rounded-xl mb-6 text-white shadow-md">
                            <i data-lucide="{{ $feature['icon'] }}" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="penilaian" class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-indigo-600 to-purple-600 text-white transition-all duration-1000 opacity-0 translate-y-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap untuk Memulai?
            </h2>
            <p class="text-xl mb-10 opacity-95">
                Penilaian DASS-42 membutuhkan waktu sekitar 10 menit untuk diselesaikan. Jawablah dengan jujur berdasarkan pengalaman Anda selama seminggu terakhir.
            </p>
            
            <a 
                href="{{ url('/dass42-test') }}" {{-- Tautan ke halaman pengisian data diri/tes --}}
                class="group bg-white text-indigo-600 px-10 py-5 rounded-xl font-bold text-lg hover:bg-gray-50 transition shadow-xl inline-flex items-center gap-3"
            >
                Mulai Penilaian DASS-42
                <i data-lucide="chevron-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
            </a>
            
            <div class="mt-8 flex items-center justify-center gap-2 text-sm opacity-90">
                <i data-lucide="shield" class="w-4 h-4"></i>
                <span>Penilaian ini bukan diagnosis medis. Silakan berkonsultasi dengan profesional kesehatan untuk evaluasi komprehensif.</span>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                        </div>
                        <span class="text-2xl font-bold">PsyCheck</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed max-w-md">
                        Platform penilaian kesehatan mental profesional yang didukung oleh instrumen DASS-42 yang tervalidasi secara ilmiah.
                    </p>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4 text-lg">Tautan Cepat</h3>
                    <div class="space-y-3">
                        @foreach(['Beranda', 'Tentang', 'Fitur', 'Penilaian'] as $item)
                            <button 
                                onclick="scrollToSection('{{ strtolower($item) }}')"
                                class="block text-gray-400 hover:text-white transition"
                            >
                                {{ $item }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold mb-4 text-lg">Kontak</h3>
                    <div class="space-y-3 text-gray-400">
                        <p>info@psycheck.com</p>
                        <p>support@psycheck.com</p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                <p>© 2025 PsyCheck. Hak cipta dilindungi. Dibangun untuk kesadaran kesehatan mental yang lebih baik.</p>
            </div>
        </div>
    </footer>
@endsection