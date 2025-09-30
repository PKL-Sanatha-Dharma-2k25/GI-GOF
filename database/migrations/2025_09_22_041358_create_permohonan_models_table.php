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
        Schema::create('permohonan_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->string('status')->default('Pending');
            $table->string('alasan');
            $table->foreignId('pemohon_id')->constrained('pemohon_models')->onDelete('cascade');
            $table->foreignId('peninjau_id')->nullable()->constrained('pemohon_models')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_models');
    }
};