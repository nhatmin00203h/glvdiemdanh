<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ImportLichCongGiao extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'lich:import {year} {month}';

    /**
     * The console command description.
     */
    protected $description = 'Import lịch Công Giáo theo tháng từ file JSON';

    public function handle(): int
    {
        $year  = (int) $this->argument('year');
        $month = str_pad($this->argument('month'), 2, '0', STR_PAD_LEFT);

        // Đường dẫn file JSON
        $path = storage_path("app/data/lich_cong_giao_{$year}_{$month}.json");

        if (!File::exists($path)) {
            $this->error("❌ Không tìm thấy file: {$path}");
            return Command::FAILURE;
        }

        $data = json_decode(File::get($path), true);

        if (!is_array($data)) {
            $this->error('❌ File JSON không hợp lệ');
            return Command::FAILURE;
        }

        $inserted = 0;
        $skipped  = 0;

        foreach ($data as $item) {

            // Validate tối thiểu theo CSDL
            if (
                !isset(
                    $item['ngay'],
                    $item['ten_le'],
                    $item['loai_le'],
                    $item['mau_le'],
                    $item['la_le_buoc']
                )
            ) {
                $skipped++;
                continue;
            }

            // Tránh import trùng ngày
            $exists = DB::table('lich_cong_giao')
                ->where('ngay', $item['ngay'])
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            $date = Carbon::parse($item['ngay']);

            // Giá trị mặc định từ JSON
            $loaiLe   = $item['loai_le'];
            $laLeBuoc = (bool) $item['la_le_buoc'];

            // ⭐ LOGIC CHỦ NHẬT – ƯU TIÊN CAO NHẤT
            if ($date->isSunday()) {
                $loaiLe   = 'chua_nhat';
                $laLeBuoc = true;
            }

            DB::table('lich_cong_giao')->insert([
                'ngay'        => $item['ngay'],
                'ten_le'      => $item['ten_le'],
                'loai_le'     => $loaiLe,
                'mau_le'      => $item['mau_le'],
                'la_le_buoc'  => $laLeBuoc,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            $inserted++;
        }

        $this->info("✅ Import xong {$inserted} ngày ({$skipped} bỏ qua) cho {$month}/{$year}");
        return Command::SUCCESS;
    }
}
