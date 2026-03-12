<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pic');
            $table->foreignId('sumber_lead_id')->constrained('sumber_leads');
            $table->foreignId('jenis_lokasi_id')->constrained('jenis_lokasis');
            $table->foreignId('perusahaan_id')->constrained('perusahaans');
            $table->decimal('nilai', 15, 2)->nullable();
            $table->enum('status', ['inquiry', 'deal', 'cancel'])->default('inquiry');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};