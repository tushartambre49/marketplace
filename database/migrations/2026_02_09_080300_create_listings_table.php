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
            Schema::create('listings', function (Blueprint $table) {
            $table->id();

            // Ownership
            $table->foreignId('provider_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Classification
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            // Content
            $table->string('title');
            $table->text('description');

            // Location
            $table->string('city');
            $table->string('suburb');

            // Pricing
            $table->decimal('price', 10, 2);
            $table->enum('price_type', ['hourly', 'fixed']);

            // Moderation Status
            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'suspended'
            ])->default('draft');

            $table->timestamps();

            // Indexing (IMPORTANT)
            $table->index('category_id');
            $table->index(['city', 'suburb']);
            $table->index('price');
            $table->index('status');

            // Full-text search
            $table->fullText(['title', 'description']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
