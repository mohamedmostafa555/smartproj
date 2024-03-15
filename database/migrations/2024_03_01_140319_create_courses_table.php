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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('Course Name');
            $table->bigInteger('Mid');
            $table->bigInteger('P-E');
            $table->bigInteger('V-E');
            $table->bigInteger('Final');
            $table->bigInteger('Total');
            $table->string('Description');
            $table->string('Goals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coures');
    }
};
