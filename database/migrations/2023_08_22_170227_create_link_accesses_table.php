<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('link_accesses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('link_id');
        $table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
        $table->ipAddress('ip');
        $table->text('user_agent');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_accesses');
    }
};