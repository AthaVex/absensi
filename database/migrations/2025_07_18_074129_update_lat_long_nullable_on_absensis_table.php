<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable()->change();
            $table->decimal('longitude', 10, 6)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->decimal('latitude', 10, 6)->nullable(false)->change();
            $table->decimal('longitude', 10, 6)->nullable(false)->change();
        });
    }
};
