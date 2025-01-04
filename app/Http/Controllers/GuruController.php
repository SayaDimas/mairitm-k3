<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Auth;
use App\Models\Materi;
use App\Models\Category;

class GuruController extends Controller
{
    public function showModules()
    {
        $modules = Module::where('teacher_id', Auth::id())->get(); // Ambil modul-modul yang dimiliki oleh guru
        return view('guru.modules.index', compact('modules')); // Kirim data modul ke view
    }
    // Menampilkan dashboard guru
    public function dashboard()
    {
        $students = User::where('role', 'siswa')->get(); // Ambil semua pengguna dengan role 'siswa'
        return view('guru.dashboard', compact('students'));
    }

    // Mengelola siswa, contoh menambah siswa baru
    public function addStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'siswa', // Set role menjadi siswa
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Siswa baru berhasil ditambahkan.');
    }

    // Menampilkan form untuk menambah modul
    public function createModule()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('guru.modules.tambah-module', compact('categories')); // Kirim data kategori ke view
    }

    // Menambahkan modul baru
    public function addModule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
        ]);

        Module::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id, // Simpan category_id
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('guru.modules.index')->with('success', 'Modul berhasil ditambahkan.');
    }

    // Fungsi untuk menampilkan form edit modul dengan materi
    public function editModule($id)
    {
        $module = Module::findOrFail($id);
        $materi = Materi::where('module_id', $id)->get(); // Ambil materi yang terkait dengan modul ini
        return view('guru.modules.edit-modul', compact('module', 'materi'));
    }

    // Fungsi untuk memperbarui modul
    public function updateModule(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $module = Module::findOrFail($id);
        $module->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('guru.modules.index')->with('success', 'Modul berhasil diperbarui!');
    }

    public function addMateri($moduleId)
    {
        // Ambil data module berdasarkan ID yang diterima
        $module = Module::findOrFail($moduleId);

        // Kirim data module ke view
        return view('guru.modules.tambah-materi', compact('module'));
    }

    public function storeMateri(Request $request, $moduleId)
{
    // Validasi input materi
    $request->validate([
        'materi.*.title' => 'required|string|max:255',
        'materi.*.content' => 'nullable|string',
        'materi.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Maksimum 10MB untuk gambar
        'materi.*.video' => 'nullable|mimes:mp4,avi,mkv|max:51200', // Maksimum 50MB untuk video
    ]);

    $module = Module::findOrFail($moduleId);

    // Iterasi dan simpan materi
    foreach ($request->input('materi') as $index => $materiData) {
        try {
            $materi = new Materi();
            $materi->module_id = $module->id;
            $materi->title = $materiData['title'];
            $materi->content = $materiData['content'] ?? '';

            // Proses upload gambar
            if ($request->hasFile("materi.$index.image")) {
                $imageFile = $request->file("materi.$index.image");
                $imagePath = $imageFile->store('materi_images', 'public');
                $materi->image = $imagePath;
            }

            // Proses upload video
            if ($request->hasFile("materi.$index.video")) {
                $videoFile = $request->file("materi.$index.video");
                $videoPath = $videoFile->store('materi_videos', 'public');
                $materi->video = $videoPath;
            }

            // Simpan materi
            $materi->save();
        } catch (\Exception $e) {
            // Tangani error
            session()->flash('error', 'Terjadi kesalahan pada materi "' . ($materiData['title'] ?? 'Tanpa Judul') . '": ' . $e->getMessage());
            return redirect()->back();
        }
    }

    return redirect()->route('guru.modules.add_materi', $module->id)->with('success', 'Materi berhasil ditambahkan');
}


    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        // Optional: Hapus media terkait (gambar, video)
        if ($materi->image) {
            \Storage::delete('public/' . $materi->image);
        }

        if ($materi->video) {
            \Storage::delete('public/' . $materi->video);
        }

        // Hapus materi
        $materi->delete();

        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }
}
