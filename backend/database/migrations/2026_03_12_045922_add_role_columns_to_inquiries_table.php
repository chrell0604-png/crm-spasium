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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->foreignId('first_contact_by_id')->nullable()->constrained('role_contacts');
            $table->foreignId('keputusan_desain_by_id')->nullable()->constrained('role_contacts');
            $table->foreignId('pengaruh_desain_by_id')->nullable()->constrained('role_contacts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn([
                'first_contact_by_id',
                'keputusan_desain_by_id',
                'pengaruh_desain_by_id'
            ]);
        });
    }
};