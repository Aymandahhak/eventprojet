<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute les migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('location');
            $table->string('category');
            $table->enum('type', ['Présentiel', 'Virtuel', 'Hybride']);
            $table->string('image')->nullable();
            $table->integer('capacity')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->boolean('is_published')->default(false);
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Annule les migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};