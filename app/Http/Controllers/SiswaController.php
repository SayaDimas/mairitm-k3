<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Siswa; // Model Siswa
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Materi;

class SiswaController extends Controller
{
    // Menampilkan dashboard siswa
    public function dashboard()
    {
        $users = User::all(); // Ambil semua pengguna
        $username = auth()->user()->name; // Ambil nama pengguna yang sedang login
        // Ambil semua kategori beserta modul-modulnya
        $categories = Category::with('modules')->get();

        // Kirim data ke view
        return view('siswa.dashboard', compact('users', 'categories', 'username'));
    }

    // Menampilkan modul berdasarkan kategori
    public function showModulesByCategory($categoryId)
    {
        // Ambil data modul berdasarkan kategori
        $modules = Module::where('category_id', $categoryId)->get();

        // Kirim data modul ke view
        return view('siswa.dashboard', compact('modules'));
    }

    // Menampilkan materi berdasarkan module_id
    public function show($module_id)
    {
        $categories = Category::all(); // Ambil semua kategori

        // Ambil semua materi berdasarkan module_id dan urutkan berdasarkan id terkecil ke terbesar
        $orderedMateris = Materi::where('module_id', $module_id)
            ->orderBy('id', 'asc') // Urutkan berdasarkan id terkecil ke terbesar
            ->get();

        // Jika tidak ada materi, tampilkan error atau pesan kosong
        if ($orderedMateris->isEmpty()) {
            return redirect()->route('modules.index')->with('error', 'Materi tidak ditemukan.');
        }

        // Ambil materi pertama yang memiliki ID terkecil
        $currentMateri = $orderedMateris->first();

        // Inisialisasi URL untuk materi sebelumnya dan materi selanjutnya
        $previousUrl = null;
        $nextUrl = null;

        // Cari materi sebelumnya dan materi selanjutnya
        $currentIndex = $orderedMateris->search(fn($materi) => $materi['id'] == $currentMateri['id']);

        // Cari materi sebelumnya
        $previousUrl = $currentIndex > 0
            ? route('materi.show', ['module_id' => $module_id, 'materi_id' => $orderedMateris[$currentIndex - 1]['id']])
            : null;

        // Cari materi selanjutnya
        $nextUrl = $currentIndex < count($orderedMateris) - 1
            ? route('materi.show', ['module_id' => $module_id, 'materi_id' => $orderedMateris[$currentIndex + 1]['id']])
            : null;

        // Kirim data ke view
        return view('siswa.showmateri', compact('orderedMateris', 'previousUrl', 'nextUrl', 'categories', 'currentMateri'));
    }
}
