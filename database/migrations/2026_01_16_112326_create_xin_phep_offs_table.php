<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('xin_phep_offs', function (Blueprint $table) {
            $table->id('xinphep_id');

            // Ai xin phép
            $table->unsignedBigInteger('user_id');

            // Xin phép cho buổi lễ nào
            $table->unsignedBigInteger('buoile_id');

            // Lý do xin phép (tuỳ chọn)
            $table->string('ly_do', 255)->nullable();

            // Thời điểm admin ghi nhận xin phép
            $table->timestamps();

            // 1 người chỉ xin phép 1 lần / buổi lễ
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
        Schema::dropIfExists('xin_phep_offs');
    }
};
