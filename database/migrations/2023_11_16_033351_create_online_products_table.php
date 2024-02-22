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
        Schema::create('online_products', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('name');
            $table->string('slug')->unique();
            $table->bigInteger('price_show');
            $table->float('rate');
            $table->bigInteger('min_price');
            $table->bigInteger('max_price');
            $table->longText('description');
            $table->string('title_landing');
            $table->string('desc_landing');
            $table->string('images_landing');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_products');
    }
};
