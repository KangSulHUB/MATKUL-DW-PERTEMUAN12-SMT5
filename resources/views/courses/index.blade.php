<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPrime - Platform E-Learning Profesional</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen">

    <!-- Navbar Publik (Dark Tech) -->
    <header class="bg-slate-900/80 backdrop-blur-md border-b border-slate-800 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-600/30">
                    E
                </div>
                <span class="text-xl font-extrabold tracking-tight text-white">Edu<span class="text-indigo-400">Prime</span></span>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-400">
                <a href="#" class="text-indigo-400 font-semibold">Beranda</a>
                <a href="#courses" class="hover:text-white transition">Katalog Kursus</a>
                <a href="#" class="hover:text-white transition">Kategori</a>
                <a href="#" class="hover:text-white transition">Tentang Kami</a>
            </nav>

            <!-- User Authentication Buttons -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-white text-sm font-semibold px-3 py-2 transition">
                    Masuk
                </a>
                <a href="#" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-lg shadow-indigo-600/20 transition duration-200">
                    Daftar Gratis
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section (Dark Gradient) -->
    <section class="bg-gradient-to-b from-indigo-950/30 via-slate-950 to-slate-950 py-16 md:py-24 border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-3xl">
            <span class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 px-3 py-1 rounded-full text-xs font-mono mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> PLATFORM PEMBELAJARAN MASA DEPAN
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight mb-6">
                Tingkatkan Keahlian Anda Bersama Para Ahli
            </h1>
            <p class="text-slate-400 text-base md:text-lg mb-8 leading-relaxed">
                Akses ratusan materi pembelajaran berkualitas tinggi untuk menunjang karir Anda di bidang teknologi, bisnis, dan desain.
            </p>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-4 max-w-lg mx-auto pt-4 border-t border-slate-800/80">
                <div>
                    <div class="text-2xl font-extrabold text-white">10K+</div>
                    <div class="text-xs text-slate-500 font-medium">Siswa Aktif</div>
                </div>
                <div>
                    <div class="text-2xl font-extrabold text-white">150+</div>
                    <div class="text-xs text-slate-500 font-medium">Instruktur Pakar</div>
                </div>
                <div>
                    <div class="text-2xl font-extrabold text-white">4.9/5</div>
                    <div class="text-xs text-slate-500 font-medium">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content / Course Catalog -->
    <main id="courses" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Section Header & Filter -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Katalog Kursus Pilihan</h2>
                <p class="text-sm text-slate-400 mt-1">Pilih materi yang sesuai dengan target belajar Anda hari ini.</p>
            </div>
            
            <!-- Category Chips -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-none">
                <button class="bg-indigo-600 text-white text-xs font-semibold px-4 py-2 rounded-lg whitespace-nowrap shadow-md shadow-indigo-600/20">Semua</button>
                <button class="bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white text-xs font-semibold px-4 py-2 rounded-lg whitespace-nowrap transition">Programming</button>
                <button class="bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white text-xs font-semibold px-4 py-2 rounded-lg whitespace-nowrap transition">Excel & Data</button>
                <button class="bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white text-xs font-semibold px-4 py-2 rounded-lg whitespace-nowrap transition">Mathematics</button>
                <button class="bg-slate-900 border border-slate-800 hover:border-slate-700 text-slate-400 hover:text-white text-xs font-semibold px-4 py-2 rounded-lg whitespace-nowrap transition">Design</button>
            </div>
        </div>

        <!-- Course Cards Grid (Dark Neon Border) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($courses as $course)
                <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl hover:border-indigo-500/50 hover:-translate-y-1 transition duration-300 flex flex-col overflow-hidden group">
                    
                    <!-- Thumbnail & Logo Display -->
                    <div class="h-44 bg-slate-950 relative flex items-center justify-center overflow-hidden border-b border-slate-800">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-950 via-slate-900 to-slate-950 opacity-90"></div>
                            <span class="relative text-indigo-400 font-mono font-bold text-base tracking-wide">
                                {{ $course->category }}
                            </span>
                        @endif
                        <span class="absolute top-3 left-3 bg-slate-950/80 backdrop-blur-md text-indigo-400 border border-indigo-500/30 text-[10px] font-mono font-bold px-2.5 py-1 rounded-md tracking-wider uppercase shadow-sm">
                            {{ $course->category }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xs font-mono font-semibold text-indigo-400 bg-indigo-500/10 px-2 py-0.5 rounded border border-indigo-500/20">Materi Kelas</span>
                                <span class="text-slate-600 text-xs">•</span>
                                <span class="text-xs text-slate-400 font-medium">Oleh {{ $course->instructor }}</span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition duration-200 line-clamp-1 mb-2">
                                {{ $course->title }}
                            </h3>
                            
                            <p class="text-slate-400 text-xs leading-relaxed line-clamp-2 mb-4">
                                {{ $course->description }}
                            </p>
                        </div>

                        <!-- Price & Action -->
                        <div class="pt-4 border-t border-slate-800 flex items-center justify-between mt-4">
                            <div>
                                <span class="text-[10px] uppercase font-mono font-bold text-slate-500 block">Investasi</span>
                                <span class="text-lg font-extrabold text-white">
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow-lg shadow-indigo-600/20 transition duration-200">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-slate-900 rounded-2xl border border-dashed border-slate-800 p-12 text-center">
                    <div class="w-12 h-12 bg-slate-950 text-slate-500 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-800">
                        📂
                    </div>
                    <h3 class="text-base font-bold text-white mb-1">Belum Ada Kursus Tersedia</h3>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto">Silakan kembali lagi nanti untuk melihat materi pembelajaran terbaru.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Footer (Dark Tech) -->
    <footer class="bg-slate-900 border-t border-slate-800 py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-500 font-mono">
            <p>© 2026 EduPrime Platform. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>