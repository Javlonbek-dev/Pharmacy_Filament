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
        Schema::create('prescription__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->nullable();
            $table->foreignId('medication_id')->nullable();
            $table->integer('quantity');
            $table->integer('dosage');
            $table->integer('frequency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription__items');
    }
};
