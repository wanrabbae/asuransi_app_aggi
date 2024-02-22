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
        Schema::create('kebakaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('online_transactions_id');
            $table->string('jenis_bangunan')->nullable();
            $table->string('nilai_bangunan')->nullable();
            $table->string('nilai_mesin_mesin')->nullable();
            $table->string('nilai_persediaan_barang')->nullable();
            $table->string('nilai_barang_dagangan')->nullable();
            $table->string('nilai_perabot_rumah_tangga')->nullable();
            $table->string('nilai_perabot_kantor_toko_gudang')->nullable();
            $table->string('dinding_luar')->nullable();
            $table->string('dinding_dalam')->nullable();
            $table->string('dinding_pemisah')->nullable();
            $table->string('lantai')->nullable();
            $table->string('balok_lantai')->nullable();
            $table->string('pilar')->nullable();
            $table->string('tiang')->nullable();
            $table->string('anak_tangga')->nullable();
            $table->string('atap')->nullable();
            $table->string('banyaknya_tingkat')->nullable();
            $table->string('fondasi')->nullable();
            $table->string('jenis_penerangan')->nullable();
            $table->string('jarak_bangunan_kiri')->nullable();
            $table->string('jenis_kontruksi_kiri')->nullable();
            $table->string('jarak_bangunan_kanan')->nullable();
            $table->string('jenis_kontruksi_kanan')->nullable();
            $table->string('jarak_bangunan_belakang')->nullable();
            $table->string('jenis_kontruksi_belakang')->nullable();
            $table->string('jarak_bangunan_depan')->nullable();
            $table->string('jenis_kontruksi_depan')->nullable();
            $table->string('jenis_alat_pemadam_kebakaran')->nullable();
            $table->string('jumlah_alat_pemadam')->nullable();
            $table->string('jarak_pos_pemadam_terdekat')->nullable();
            $table->string('barang_milik_orang_lain')->nullable();
            $table->string('barang_berbahaya')->nullable();
            $table->string('nama_asuransi_lain')->nullable();
            $table->string('nama_asuransi_penolak')->nullable();
            $table->string('penjelasan_kebakaran')->nullable();
            $table->string('waktu_pertangungan')->nullable();
            $table->string('akhir_pertangungan')->nullable();
            $table->string('jenis_pertangunagan_a')->nullable();
            $table->string('jenis_pertangunagan_b')->nullable();
            $table->string('jenis_pertangunagan_c')->nullable();
            $table->string('jenis_pertangunagan_d')->nullable();
            $table->string('jenis_pertangunagan_e')->nullable();
            $table->string('jenis_pertangunagan_f')->nullable();
            $table->string('jenis_pertangunagan_g')->nullable();
            $table->string('jenis_pertangunagan_h')->nullable();
            $table->string('Nama_pemilik_atau_penyewa')->nullable();
            $table->string('Besarnya_uang_sewa_per_bulan_atau_tahun')->nullable();
            $table->string('Jangka_waktu_kontrak_atau_sewa_menyewa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebakaran');
    }
};
