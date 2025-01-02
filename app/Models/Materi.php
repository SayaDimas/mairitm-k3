<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $fillable = [
        'module_id', // ID module yang terkait
        'materi_ke', // Urutan materi
        'type', // Jenis konten (text, image, video)
        'title', // Judul materi
        'content', // Isi materi (untuk teks)
        'image', // Path gambar (untuk jenis gambar)
        'video', // Path video (untuk jenis video)
    ];

    /**
     * Relasi ke model Module
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
