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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('logic_score')->default(0);
            $table->integer('numeric_score')->default(0);
            $table->integer('verbal_score')->default(0);
            //status ujian enum (start, done)
            $table->enum('numeric_status', ['started', 'done'])->default('started');
            $table->enum('verbal_status', ['started', 'done'])->default('started');
            $table->enum('logic_status', ['started', 'done'])->default('started');
            //timer ujian per kategori
            $table->integer('numeric_timer')->nullable();
            $table->integer('verbal_timer')->nullable();
            $table->integer('logic_timer')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
