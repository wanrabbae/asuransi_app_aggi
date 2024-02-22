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
        Schema::create('redeem_poins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('redeem_code');
            $table->string('redeem_amount');
            $table->tinyInteger('redeem_status')->comment('1-request,2-process,3-success');
            $table->datetime('redeem_request_date');
            $table->datetime('redeem_approve_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redeem_poins');
    }
};
