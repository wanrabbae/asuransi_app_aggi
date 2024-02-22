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
        Schema::table('online_transactions', function (Blueprint $table) {
            $table->string('polis')->nullable();
            $table->string('no_polis')->nullable();
            $table->date('upload_polis_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('online_transactions', function (Blueprint $table) {
            $table->dropColumn('polis');
            $table->dropColumn('no_polis');
            $table->dropColumn('upload_polis_date');
        });
    }
};
