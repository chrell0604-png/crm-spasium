<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_cancels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->foreignId('cancel_reason_id')->constrained('cancel_reasons')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_cancels');
    }
};