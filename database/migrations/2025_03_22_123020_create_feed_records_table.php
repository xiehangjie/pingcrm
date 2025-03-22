<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feed_records', function (Blueprint $table) {
            $table->id();
            $table->timestamp('feed_time')->useCurrent()->comment('投喂时间');
            $table->morphs('target'); // 关联enclosures/crocodiles
            $table->foreignId('feed_id')->constrained()->comment('饲料类型');
            $table->decimal('amount', 8, 2)->comment('投喂量(kg)');
            $table->foreignId('operator_id')->constrained('users')->comment('操作人员');
            $table->decimal('fcr', 5, 2)->nullable()->comment('饲料转化率');
            $table->timestamps();
            
            // 多态关联索引
            $table->index(['target_id', 'target_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_records');
    }
};
