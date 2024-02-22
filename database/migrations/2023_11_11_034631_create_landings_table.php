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
        Schema::create('landings', function (Blueprint $table) {
            $table->id();
            $table->string('favicon');
            $table->string('head_logo');
            $table->string('head_title');
            $table->string('head_desc');
            $table->string('head_image');
            $table->string('video_link');
            $table->string('title_product');
            $table->string('title_join');
            $table->string('join_1');
            $table->string('title_join_1');
            $table->string('join_2');
            $table->string('title_join_2');
            $table->string('desc_join');
            $table->string('image_join');
            $table->string('address');
            $table->string('address_city');
            $table->string('address_province');
            $table->string('address_poscode');
            $table->string('hotline');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('tweet_x');
            $table->string('instagram');
            $table->string('tiktok');
            $table->string('youtube');
            $table->string('kawan_head_title');
            $table->string('kawan_head_desc');
            $table->string('kawan_head_images');
            $table->string('kawan_content_video_img');
            $table->string('kawan_content_video');
            $table->string('kawan_content_title');
            $table->string('kawan_content_title_2');
            $table->string('kawan_content_svg_1');
            $table->string('kawan_content_title_svg_1');
            $table->string('kawan_content_desc_svg_1');
            $table->string('kawan_content_svg_2');
            $table->string('kawan_content_title_svg_2');
            $table->string('kawan_content_desc_svg_2');
            $table->string('kawan_content_svg_3');
            $table->string('kawan_content_title_svg_3');
            $table->string('kawan_content_desc_svg_3');
            $table->string('kawan_content_img');
            $table->string('aturan_title');
            $table->string('aturan_desc');
            $table->string('kebijakan_title');
            $table->string('kebijakan_desc');
            $table->string('title_header_klaim');
            $table->string('desc_header_klaim');
            $table->string('img_header_klaim');
            $table->string('title_body_klaim');
            $table->string('desc_body_klaim');
            $table->string('title_step_1_klaim');
            $table->string('desc_step_1_klaim');
            $table->string('title_step_2_klaim');
            $table->string('desc_step_2_klaim');
            $table->string('title_step_3_klaim');
            $table->string('desc_step_3_klaim');
            $table->string('title_step_4_klaim');
            $table->string('desc_step_4_klaim');
            $table->integer('admin_fee');
;           $table->integer('materai_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landings');
    }
};
