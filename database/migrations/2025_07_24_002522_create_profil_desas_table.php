<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa')->default('Desa Metesih');
            $table->text('visi_misi')->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->integer('penduduk_lk')->nullable();
            $table->integer('penduduk_pr')->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->integer('kk_lk')->nullable();
            $table->integer('kk_pr')->nullable();
            $table->integer('jumlah_rt')->nullable();
            $table->integer('jumlah_rw')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->string('batas_utara')->nullable();
            $table->string('batas_selatan')->nullable();
            $table->string('batas_timur')->nullable();
            $table->string('batas_barat')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
