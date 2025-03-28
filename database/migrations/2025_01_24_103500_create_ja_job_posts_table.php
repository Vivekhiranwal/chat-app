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
        Schema::create('ja_job_posts', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('user_id'); // Foreign key reference to users
            $table->string('number_of_days'); // Duration in days
            $table->decimal('total_cost', 10, 2); // Total cost, e.g., 40.00
            $table->string('zipcode'); // Zipcode of the location
            $table->string('area'); // Area size
            $table->string('city'); // City name
            $table->string('project_type'); // Project type (e.g., "Mid-range")
            $table->json('floor_maps_image')->nullable(); // Floor map images stored as JSON
            $table->text('description')->nullable(); // Description (optional)
            $table->string('tags')->nullable(); // Tags (comma-separated or string)
            $table->json('image_paths')->nullable(); // Paths to uploaded images (JSON format)
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ja_job_posts');
    }
};
