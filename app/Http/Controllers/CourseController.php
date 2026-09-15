<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // Tampilan Beranda Pengguna (Public)
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    // Tampilan Dashboard Admin (Manage Data)
    public function adminIndex()
    {
        $courses = Course::latest()->get();
        return view('admin.courses', compact('courses'));
    }

    // Simpan Kursus Baru (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);

        return redirect()->route('admin.courses')->with('success', 'Kursus berhasil ditambahkan!');
    }

    // Update Data Kursus (Admin)
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric'
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses')->with('success', 'Data kursus berhasil diperbarui!');
    }

    // Hapus Data Kursus (Admin)
    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();

        return redirect()->route('admin.courses')->with('success', 'Kursus berhasil dihapus!');
    }
}