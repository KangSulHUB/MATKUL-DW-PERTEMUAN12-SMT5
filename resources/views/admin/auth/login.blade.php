<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Authentication - EduPrime Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 font-sans text-slate-100 antialiased min-h-screen flex items-center justify-center p-4 md:p-6">

    <div class="w-full max-w-4xl bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Left Section: Branding & Tech Info -->
        <div class="bg-gradient-to-br from-indigo-900 via-slate-900 to-slate-950 p-8 md:p-10 flex flex-col justify-between border-b md:border-b-0 md:border-r border-slate-800">
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-500/30">
                        E
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-white">Edu<span class="text-indigo-400">Prime</span></span>
                </div>

                <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs px-3 py-1 rounded-full font-mono mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> SYSTEM PORTAL v2.4
                </div>

                <h2 class="text-2xl font-black text-white tracking-tight leading-snug mb-3">
                    Manajemen Platform & Control Center
                </h2>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Masuk menggunakan akun terverifikasi untuk mengelola katalog kursus, pengajar, serta aset media e-learning.
                </p>
            </div>

            <div class="pt-8 border-t border-slate-800/80 mt-8">
                <div class="flex items-center gap-2 text-[11px] font-mono text-slate-500">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span>256-bit Encrypted Session</span>
                </div>
            </div>
        </div>

        <!-- Right Section: Login Form -->
        <div class="p-8 md:p-10 flex flex-col justify-center bg-slate-900">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-white mb-1">Masuk ke Dashboard</h3>
                <p class="text-xs text-slate-400">Masukkan kredensial administrator Anda.</p>
            </div>

            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-3.5 py-2.5 rounded-lg mb-6 text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@eduprime.id" 
                           class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3.5 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition font-mono">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Password</label>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••" 
                           class="w-full bg-slate-950 border border-slate-800 rounded-lg px-3.5 py-2.5 text-sm text-slate-100 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition font-mono">
                </div>

                <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm py-2.5 px-4 rounded-lg shadow-lg shadow-indigo-600/20 transition duration-200 mt-2 flex items-center justify-center gap-2">
                    <span>Authenticating</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-800/60 pt-4">
                <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-slate-300 transition">← Kembali ke Beranda Utama</a>
            </div>
        </div>

    </div>

</body>
</html>