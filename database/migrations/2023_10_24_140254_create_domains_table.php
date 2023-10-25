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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->unique();
            $table->string('description')->nullable();
            $table->unsignedInteger('aliases')->default(0);
            $table->unsignedInteger('mailboxes')->default(0);
            $table->unsignedBigInteger('max_quota')->default(0);
            $table->unsignedBigInteger('quota')->default(0);
            $table->string('transport')->nullable();
            $table->boolean('backup_mx')->default(0);
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
