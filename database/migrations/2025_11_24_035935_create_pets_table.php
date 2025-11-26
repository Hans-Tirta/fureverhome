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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('name');
            $table->integer('age')->comment('Age in months');
            $table->enum('gender', ['male', 'female']);
            $table->enum('size', ['small', 'medium', 'large']);
            $table->string('color');
            $table->string('breed')->nullable();
            $table->text('description');
            $table->text('health_status')->nullable();
            $table->string('vaccination_status')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('image')->nullable();
            $table->timestamp('adopted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
