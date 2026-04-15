<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Chỉ thêm nếu cột chưa tồn tại để tránh lỗi khi merge
        if (!Schema::hasColumn('san_pham', 'status')) {
            Schema::table('san_pham', function (Blueprint $table) {
                $table->tinyInteger('status')->default(1)->after('nhu_cau_nuoc');
            });
        }
    }

    public function down(): void
    {
        Schema::table('san_pham', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};