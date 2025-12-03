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
            $table->integer('age_years')->default(0);
            $table->integer('age_months')->default(0);
            $table->enum('gender', ['male', 'female']);
            $table->enum('size', ['small', 'medium', 'large']);
            $table->text('description');
            $table->string('breed')->nullable();
            $table->string('color')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('health_status')->nullable();
            $table->string('vaccination_status')->nullable();
            $table->boolean('is_neutered')->default(false);
            $table->boolean('is_house_trained')->default(false);
            $table->boolean('good_with_kids')->default(false);
            $table->boolean('good_with_pets')->default(false);
            $table->decimal('adoption_fee', 10, 2)->nullable();
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
