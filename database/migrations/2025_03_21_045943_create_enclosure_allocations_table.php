<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enclosure_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crocodile_id')->constrained()->onDelete('cascade');
            $table->foreignId('enclosure_id')->constrained()->onDelete('cascade');
            $table->dateTime('allocated_at')->useCurrent()->comment('分配时间');
            $table->timestamps();

            // 复合索引优化查询性能
            $table->index(['enclosure_id', 'allocated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enclosure_allocations');
    }
};
