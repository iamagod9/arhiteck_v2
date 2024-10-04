<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estate_viewings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time', 32);
            $table->string('phone', 18);
            $table->enum('status', ['Новая', 'Отменено', 'Завершено'])->default('Новая');
            $table->foreignId('estate_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_viewings');
    }
};