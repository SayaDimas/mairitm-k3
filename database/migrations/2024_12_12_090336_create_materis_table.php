<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->onDelete('cascade'); // Relasi dengan module
            $table->integer('materi_ke')->default(1)->change();
            $table->enum('type', ['text', 'image', 'video']); // Jenis materi
            $table->string('title'); // Judul materi
            $table->text('content')->nullable(); // Isi materi (untuk teks)
            $table->string('image')->nullable(); // Path gambar (untuk gambar)
            $table->string('video')->nullable(); // Path video (untuk video)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materis');
        Schema::table('materis', function (Blueprint $table) {
            $table->integer('materi_ke')->nullable()->change();
        });
    }
}
