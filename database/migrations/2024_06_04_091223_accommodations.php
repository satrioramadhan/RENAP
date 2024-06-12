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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('image_url', 255)->nullable();
            $table->string('url_gmaps', 255)->nullable();
            $table->string('address', 100);
            $table->decimal('rating', 14, 2);
            $table->integer('price');
            $table->integer('public_facilities');
            $table->string('name_facilities_public', 255);
            $table->integer('facilities');
            $table->string('name_facilities', 255);
            $table->integer('distance_to_city');
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
