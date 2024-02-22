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
        Schema::create('online_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('product_id');
            $table->string('nasabah_name')->nullable();
            $table->string('nasabah_id')->nullable();
            $table->string('nasabah_email')->nullable();
            $table->string('nasabah_phone')->nullable();
            $table->text('nasabah_address')->nullable();
            $table->string('nasabah_city')->nullable();
            $table->string('nasabah_province')->nullable();
            $table->string('nasabah_district')->nullable();
            $table->string('nasabah_poscode')->nullable();
            $table->string('nasabah_dob')->nullable();
            $table->string('tertanggung_name')->nullable();
            $table->string('tertanggung_id')->nullable();
            $table->string('tertanggung_email')->nullable();
            $table->string('tertanggung_phone')->nullable();
            $table->text('tertanggung_address')->nullable();
            $table->string('tertanggung_district')->nullable();
            $table->string('tertanggung_city')->nullable();
            $table->string('tertanggung_province')->nullable();
            $table->string('tertanggung_poscode')->nullable();
            $table->string('tertanggung_pob')->nullable();
            $table->string('tertanggung_dob')->nullable();
            $table->string('tertanggung_work')->nullable();
            $table->string('status_bangunan')->nullable();
            $table->string('nilai_bangunan')->nullable();
            $table->string('nilai_lainnya')->nullable();
            $table->string('nilai_premi')->nullable();
            $table->string('province_bangunan')->nullable();
            $table->string('kota_bangunan')->nullable();
            $table->string('district_bangunan')->nullable();
            $table->string('poscode_bangunan')->nullable();
            $table->text('address_bangunan')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_nilai')->nullable();
            $table->string('biaya_materai')->nullable();
            $table->string('biaya-admin')->nullable();
            $table->string('total_payment')->nullable();
            $table->tinyInteger('status')->comment('1-request,2-pending,3-complate')->default(1);
            $table->string('referal_code')->nullable();
            $table->string('referal_code_upline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_transactions');
    }
};
