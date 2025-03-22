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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crocodile_id')->constrained()->onDelete('cascade');
            $table->date('check_date')->comment('检查日期');
            $table->decimal('weight', 7, 2)->comment('体重(kg)');
            $table->decimal('length', 6, 2)->comment('体长(cm)');
            $table->decimal('temperature', 4, 1)->comment('体温(℃)');
            $table->enum('health_status', ['健康', '观察中', '患病'])->comment('健康状态');
            $table->text('symptoms')->nullable()->comment('临床症状');
            $table->text('diagnosis')->nullable()->comment('诊断结果');
            $table->foreignId('veterinarian_id')->constrained('users')->comment('负责兽医');
            $table->timestamps();

            // 时空数据索引
            $table->index(['crocodile_id', 'check_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
