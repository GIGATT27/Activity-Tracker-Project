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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Activity name
            $table->text('description')->nullable(); // Description of the activity (nullable)
            $table->string('status')->default('pending'); // Activity status with a default value of 'pending'
            $table->text('remarks')->nullable(); // Remarks for the activity (nullable)
            $table->unsignedBigInteger('user_id'); // Foreign key for the user who updated the activity
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
