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
        Schema::create('ahli_waris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id');
            $table->string('name');
            $table->string('no_id')->nullable();
            $table->string('email')->nullable();
            $table->string('pob');
            $table->string('dob');
            $table->string('relationship');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahli_waris');
    }
};
