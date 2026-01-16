<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id('qrcode_id');

            // Token QR (duy nhất)
            $table->string('token', 191)->unique();

            // Mỗi buổi lễ chỉ có 1 QR
            $table->unsignedBigInteger('buoile_id');

            // Trạng thái QR (admin bật / tắt)
            $table->enum('trangthai', ['active', 'inactive'])
                  ->default('active');

            $table->timestamps();

            // 1 buổi lễ = 1 QR
            $table->unique('buoile_id');

            $table->foreign('buoile_id')
                  ->references('buoile_id')
                  ->on('buoi_les')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
