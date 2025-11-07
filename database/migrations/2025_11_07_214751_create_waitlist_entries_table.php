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
        Schema::create('waitlist_entries', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('referral_code', 8)->unique();
            $table->foreignId('referred_by_id')->nullable()->constrained('waitlist_entries')->onDelete('set null');
            $table->json('metadata')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('email');
            $table->index('referral_code');
            $table->index('referred_by_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waitlist_entries');
    }
};
