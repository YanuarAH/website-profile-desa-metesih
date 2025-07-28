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
            Schema::create('r_w_s', function (Blueprint $table) {
                $table->id();
                $table->foreignId('dusun_id')->constrained('dusuns')->onDelete('cascade');
                $table->string('nomor');
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_w_s');
    }
};
