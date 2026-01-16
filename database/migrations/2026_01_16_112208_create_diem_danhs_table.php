<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diem_danhs', function (Blueprint $table) {
            $table->id('diemdanh_id');

            // Ai điểm danh
            $table->unsignedBigInteger('user_id');

            // Điểm danh cho buổi lễ nào
            $table->unsignedBigInteger('buoile_id');

            // Thời điểm quét (GIỜ SERVER)
            $table->dateTime('thoigian_quet');

            // Trạng thái trễ / đúng giờ
            $table->boolean('tre')->default(false);

            // Vị trí hợp lệ hay không (KHÔNG lưu GPS)
            $table->boolean('vitri_hople')->default(false);

            $table->timestamps();

            // 1 người chỉ điểm danh 1 lần / buổi lễ
            $table->unique(['user_id', 'buoile_id']);

            // Foreign keys
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreign('buoile_id')
                  ->references('buoile_id')
                  ->on('buoi_les')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diem_danhs');
    }
};
