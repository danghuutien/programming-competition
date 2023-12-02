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
        Schema::create('seos', function (Blueprint $table) {
            $table->string('type', 45);
            $table->bigInteger('type_id');
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('robots', 45)->nullable();
            $table->string('social_image')->nullable();
            $table->text('social_title')->nullable();
            $table->text('social_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
