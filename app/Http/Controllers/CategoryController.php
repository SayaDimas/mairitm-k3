<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Module;
class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
         // Ambil kategori berdasarkan ID beserta modulnya
        $modules = Module::where('category_id', $category->id)->get();

        $categories = Category::all();

         // Kirim variabel 'category' dan 'categories' ke view
         return view('siswa.showmodule', compact('category', 'modules', 'categories'));
    }
}
