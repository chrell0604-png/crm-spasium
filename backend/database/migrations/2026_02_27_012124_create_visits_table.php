<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('visitor_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->string('purpose')->nullable();
            $table->string('status')->default('prospect');
            $table->string('type')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('lead_status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};