<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->integer('capacity');
            $table->string('image')->nullable();
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}; 