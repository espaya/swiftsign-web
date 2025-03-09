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
        Schema::create('log_attendance', function (Blueprint $table) {
            $table->id();
            $table->text('userID');
            $table->text('session_id');
            $table->text('logged_at');
            $table->text('signed_out_at')->nullable();
            $table->text('expired')->nullable();
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_attendance');
    }
};
