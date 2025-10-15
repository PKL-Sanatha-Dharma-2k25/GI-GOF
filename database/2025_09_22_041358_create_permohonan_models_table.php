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
            $table->string('no_permohonan')->unique();
            $table->date('tgl_pengajuan');
            $table->date('tgl_selesai')->nullable();
            $table->unsignedBigInteger('est_biaya')->nullable();
            $table->unsignedBigInteger('akt_biaya')->nullable();
            $table->text('foto_sebelum');
            $table->text('foto_sesudah')->nullable();
            $table->text('foto_bukti_pembayaran')->nullable();
            $table->string('kepentingan')->nullable();
            $table->string('catatan_peninjau')->nullable();
            $table->string('alasan_permohonan');

            $table->foreignId('kode_barang')->constrained('master_barang_models')->onDelete('cascade');
            $table->foreignId('lokasi_id')->constrained('master_lokasi_models')->default(1);
            $table->foreignId('jenis_permohonan_id')->constrained('master_jenis_permohonan_models')->default(1);
            $table->foreignId('status_id')->constrained('master_status_models')->default(1);
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