<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buoi_les', function (Blueprint $table) {
            $table->id('buoile_id');

            // 1 ngày = 1 buổi lễ
            $table->date('ngayle');

            // Thời gian buổi lễ (server time)
            $table->time('gio_batdau');
            $table->time('gio_tre');
            $table->time('gio_ketthuc');

            // Loại lễ (phục vụ hiển thị nhanh)
            $table->enum('loai_le', [
                'chua_nhat',
                'le_trong',
                'le_kinh',
                'le_nho',
                'thuong_nien',
            ]);

            // Liên kết lịch Công Giáo (dữ liệu gợi ý)
            $table->unsignedBigInteger('lich_cong_giao_id')->nullable();

            // Admin bật / tắt buổi lễ
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // 1 ngày chỉ có 1 buổi lễ
            $table->unique('ngayle');

            // Foreign key (nullable)
            $table->foreign('lich_cong_giao_id')
                  ->references('lich_cong_giao_id')
                  ->on('lich_cong_giao')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buoi_les');
    }
};
