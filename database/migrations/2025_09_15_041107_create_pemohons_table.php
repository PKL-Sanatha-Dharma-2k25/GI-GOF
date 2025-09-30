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
        Schema::create('pemohon_models', function (Blueprint $table) {
    $table->id();
    $table->string('username')->unique();
    $table->bigInteger('dept_id')->unsigned();
    $table->string('password');
    $table->integer('role')->default(0); // misalnya 0=user biasa, 1=admin
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon_models');
    }
};
