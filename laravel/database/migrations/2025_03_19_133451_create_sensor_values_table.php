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
        Schema::create('sensor_values', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('sensor_id');
            $table->string('key');
            $table->float('value', precision: 24);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_values');
    }
};
