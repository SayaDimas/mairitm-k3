<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Menampilkan Dashboard Admin
    public function dashboard()
    {
        $users = User::all(); // Ambil semua pengguna
        return view('admin.dashboard', compact('users'));
    }

    // Ubah Role Pengguna
    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Role pengguna berhasil diubah.');
    }

    // Tambah Admin Baru
    public function createAdmin(Request $request)
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
            'role' => 'admin', // Set role menjadi admin
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin baru berhasil ditambahkan.');
    }
}
