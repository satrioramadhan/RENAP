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
        Schema::create('weights', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('weight_rating', 14, 7);
            $table->decimal('weight_price', 14, 7);
            $table->decimal('weight_distance', 14, 7);
            $table->decimal('weight_public_facilities', 14, 7);
            $table->decimal('weight_facilities', 14, 7);
            $table->decimal('weight_distance_to_city', 14, 7);
            $table->timestamps(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weights');
    }
};
