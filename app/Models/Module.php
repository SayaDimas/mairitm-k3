<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    // Field yang dapat diisi melalui mass assignment
    protected $fillable = [
        'title', 'description', 'teacher_id', 'category_id',
    ];

    /**
     * Relasi ke model User (sebagai teacher).
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relasi ke model Materi.
     */
    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
