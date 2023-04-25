<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mundo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('imagen');
            $table->unsignedBigInteger('grado_id');
            $table->foreign('grado_id')->references('id')->on('grado')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mundo');
    }
};