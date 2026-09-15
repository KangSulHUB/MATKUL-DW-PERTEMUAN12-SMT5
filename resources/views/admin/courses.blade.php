<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EduPrime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans text-slate-800">

    <div class="flex min-h-screen">
        <!-- Sidebar Admin -->
        <aside class="w-64 bg-slate-900 text-white flex flex-col p-6">
            <h1 class="text-xl font-bold tracking-wider mb-8 text-indigo-400">ADMIN PANEL</h1>
            <nav class="space-y-3 font-medium text-sm flex-1">
                <a href="{{ route('admin.courses') }}" class="block px-4 py-2.5 rounded-lg bg-indigo-600 text-white">Kelola Kursus</a>
                <a href="{{ route('home') }}" target="_blank" class="block px-4 py-2.5 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition">Lihat Web Utama ↗</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Manajemen Kursus</h2>
                    <p class="text-xs text-slate-500">Tambah, ubah pengajar, materi, logo/gambar, atau hapus data kursus.</p>
                </div>
                <button onclick="openAddModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-lg shadow-sm">
                    + Tambah Kursus
                </button>
            </div>

            <!-- Tambahkan penampil pesan sukses dan error-->
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500/30 text-rose-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Table Data Kursus -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left text-sm border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                        <tr>
                            <th class="p-4">Logo/Gambar</th>
                            <th class="p-4">Judul & Kategori</th>
                            <th class="p-4">Pengajar</th>
                            <th class="p-4">Harga</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($courses as $course)
                            <tr class="hover:bg-slate-50/80">
                                <td class="p-4">
                                    @if($course->image)
                                        <img src="{{ asset('storage/' . $course->image) }}" class="w-12 h-12 object-cover rounded-lg border">
                                    @else
                                        <div class="w-12 h-12 bg-slate-100 rounded-lg border flex items-center justify-center text-xs text-slate-400">No Image</div>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-slate-900">{{ $course->title }}</div>
                                    <span class="text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded font-medium">{{ $course->category }}</span>
                                </td>
                                <td class="p-4 text-slate-600">{{ $course->instructor }}</td>
                                <td class="p-4 font-semibold text-slate-900">Rp {{ number_format($course->price, 0, ',', '.') }}</td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        <button onclick='openEditModal(@json($course))' class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold px-3 py-1.5 rounded-md">Edit</button>
                                        
                                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white text-xs font-semibold px-3 py-1.5 rounded-md">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">Belum ada data kursus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Modal Form (Create / Edit) -->
    <div id="courseModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl">
            <h3 id="modalTitle" class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b">Tambah Kursus Baru</h3>
            
            <form id="courseForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" id="formMethod" name="_method" value="POST">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Kursus</label>
                        <input type="text" id="inputTitle" name="title" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori</label>
                        <select id="inputCategory" name="category" class="w-full border rounded-lg px-3 py-2 text-sm">
                            <option value="Mathematics">Mathematics</option>
                            <option value="Excel & Data">Excel & Data</option>
                            <option value="Programming">Programming</option>
                            <option value="Design">Design</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Pengajar</label>
                        <input type="text" id="inputInstructor" name="instructor" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Harga (Rp)</label>
                        <input type="number" id="inputPrice" name="price" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Logo / Gambar Kursus (PNG/SVG/JPG)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Materi</label>
                    <textarea id="inputDescription" name="description" rows="3" required class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-xs font-semibold text-slate-600">Batal</button>
                    <button type="submit" class="px-4 py-2 text-xs font-semibold bg-indigo-600 text-white rounded-lg">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('courseModal');
        const form = document.getElementById('courseForm');

        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Kursus Baru';
            form.action = "{{ route('admin.courses.store') }}";
            document.getElementById('formMethod').value = 'POST';
            form.reset();
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditModal(course) {
            document.getElementById('modalTitle').innerText = 'Edit Data Kursus';
            form.action = `/admin/courses/${course.id}`;
            document.getElementById('formMethod').value = 'PUT';
            
            document.getElementById('inputTitle').value = course.title;
            document.getElementById('inputCategory').value = course.category;
            document.getElementById('inputInstructor').value = course.instructor;
            document.getElementById('inputPrice').value = course.price;
            document.getElementById('inputDescription').value = course.description;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>