<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lich_cong_giao', function (Blueprint $table) {
            $table->id('lich_cong_giao_id');

            $table->date('ngay');

            $table->string('ten_le', 191);

            $table->enum('loai_le', [
                'chua_nhat',
                'le_trong',
                'le_kinh',
                'le_nho',
                'thuong_nien',
            ]);

            $table->string('mau_le', 50)->nullable();

            $table->boolean('la_le_buoc')->default(false);

            $table->timestamps();

            $table->unique(['ngay', 'ten_le']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_cong_giao');
    }
};
