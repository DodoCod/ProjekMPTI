<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PsyCheck - Kenali Kesehatan Mental Anda</title>

    <script src="https://cdn.tailwindcss.com"></script>
        
    {{-- Link Font Utama --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes floatDelay1 { 0%, 100% { transform: translateY(0px) translateX(0px); } 50% { transform: translateY(-15px) translateX(5px); } }
        @keyframes floatDelay2 { 0%, 100% { transform: translateY(0px) translateX(0px); } 50% { transform: translateY(-10px) translateX(-5px); } }
        
        .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-floatDelay1 { animation: floatDelay1 3s ease-in-out infinite; }
        .animate-floatDelay2 { animation: floatDelay2 3.5s ease-in-out infinite; animation-delay: 0.5s; }
    </style>
</head>
<body class="min-h-screen bg-white font-sans bg-red-500">
    
    @yield('content')
    
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Fungsi untuk scroll ke section
        function scrollToSection(id) {
            document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
            document.getElementById('mobile-menu')?.classList.add('max-h-0', 'opacity-0');
            document.getElementById('mobile-menu')?.classList.remove('max-h-64', 'opacity-100');
            // Catatan: Ini memerlukan Lucide diinisialisasi sebelum dipanggil
            if (document.getElementById('menu-icon')) {
                document.getElementById('menu-icon').innerHTML = lucide.createIcons()['menu'].toMarkup();
            }
        }

        // Toggle menu mobile & Inisialisasi Ikon setelah DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            // PENTING: Inisialisasi ikon Lucide di sini (mengatasi masalah ikon hilang)
            lucide.createIcons(); 
            
            const menuButton = document.getElementById('menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            if (menuButton) {
                 menuButton.addEventListener('click', () => {
                    const isOpen = mobileMenu.classList.contains('max-h-64');
                    if (isOpen) {
                        mobileMenu.classList.add('max-h-0', 'opacity-0');
                        mobileMenu.classList.remove('max-h-64', 'opacity-100');
                        // Update ikon menu
                        if (menuIcon) menuIcon.innerHTML = lucide.createIcons()['menu'].toMarkup();
                    } else {
                        mobileMenu.classList.add('max-h-64', 'opacity-100');
                        mobileMenu.classList.remove('max-h-0', 'opacity-0');
                        if (menuIcon) menuIcon.innerHTML = lucide.createIcons()['x'].toMarkup();
                    }
                });
            }

            // Intersection Observer untuk animasi (tetap)
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('opacity-100', 'translate-y-0');
                            entry.target.classList.remove('opacity-0', 'translate-y-10');
                        }
                    });
                },
                { threshold: 0.1 }
            );

            document.querySelectorAll('section[id]').forEach((section) => observer.observe(section));
        });
    </script>
</body>
</html>