<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('description'); // 緯度カラム
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');  // 経度カラム
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']); // カラム削除
        });
    }
};
