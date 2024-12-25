<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Auth;
use App\Models\Materi;

class GuruController extends Controller
{
    // Menampilkan dashboard guru
    public function dashboard()
    {
        // Contoh data yang bisa ditampilkan pada dashboard
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

    // Edit siswa
    public function editStudent(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('guru.dashboard')->with('success', 'Data siswa berhasil diubah.');
    }

    // Hapus siswa
    public function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('guru.dashboard')->with('success', 'Siswa berhasil dihapus.');
    }

    public function showModules()
    {
        $modules = Module::where('teacher_id', Auth::id())->get(); // Hanya modul yang dibuat oleh guru yang sedang login
        return view('guru.modules.index', compact('modules'));
    }
    public function createModule()
    {
        return view('guru.modules.tambah-module'); // Pastikan file ini ada
    }

    // Menambahkan modul baru
    public function addModule(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Module::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => Auth::id(), // Menggunakan ID guru yang sedang login
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
    // Validate the incoming request data
    $request->validate([
        'materi.*.title' => 'required|string|max:255',
        'materi.*.content' => 'nullable|string', // Optional for image and video
        'materi.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max image size
        'materi.*.video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // 10MB max video size
    ]);

    $module = Module::findOrFail($moduleId);

    // Iterate over the materi data and store it
    foreach ($request->input('materi') as $index => $materiData) {
        try {
            $materi = new Materi();
            $materi->module_id = $module->id;
            $materi->title = $materiData['title'];
            $materi->content = $materiData['content'] ?? '';

            // Proses upload gambar
            if ($request->hasFile("materi.$index.image")) {
                $imageFile = $request->file("materi.$index.image");
                $imagePath = $imageFile->store('materi_images', 'public'); // Simpan ke folder storage/app/public/materi_images
                $materi->image = $imagePath;
            }

            // Proses upload video
            if ($request->hasFile("materi.$index.video")) {
                $videoFile = $request->file("materi.$index.video");
                $videoPath = $videoFile->store('materi_videos', 'public'); // Simpan ke folder storage/app/public/materi_videos
                $materi->video = $videoPath;
            }

            // Simpan materi ke database
            $materi->save();
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah
            session()->flash('error', 'Terjadi kesalahan pada materi "' . ($materiData['title'] ?? 'Tanpa Judul') . '": ' . $e->getMessage());
            return redirect()->back();
        }
    }

    return redirect()->route('guru.modules.add_materi', $module->id)->with('success', 'Materi berhasil ditambahkan');
}

private function getUploadErrorMessage($file)
{
    $error = $file->getError();

    switch ($error) {
        case UPLOAD_ERR_INI_SIZE:
            return 'Ukuran file melebihi batas yang diizinkan di konfigurasi PHP (upload_max_filesize)';
        case UPLOAD_ERR_FORM_SIZE:
            return 'Ukuran file melebihi batas yang diizinkan dalam form HTML (MAX_FILE_SIZE)';
        case UPLOAD_ERR_PARTIAL:
            return 'File hanya terupload sebagian';
        case UPLOAD_ERR_NO_FILE:
            return 'Tidak ada file yang diupload';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Folder sementara tidak ditemukan';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Gagal menulis file ke disk';
        case UPLOAD_ERR_EXTENSION:
            return 'Ekstensi PHP membatasi file upload';
        default:
            return 'Kesalahan tak terduga terjadi saat upload file';
    }
}


public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        // Optional: Delete the associated media (image, video) from storage
        if ($materi->image) {
            \Storage::delete('public/' . $materi->image);
        }

        if ($materi->video) {
            \Storage::delete('public/' . $materi->video);
        }

        // Delete the materi
        $materi->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Materi berhasil dihapus');
    }

}
