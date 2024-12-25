<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Izinkan mass assignment untuk kolom tertentu
    protected $fillable = ['name', 'description'];

    // Relasi ke Module
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
