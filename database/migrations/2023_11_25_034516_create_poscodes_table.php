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
        Schema::create('poscodes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('poscode');
            $table->string('name_regenciest');
            $table->string('name_districts');
            $table->string('name_villages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poscodes');
    }
};
