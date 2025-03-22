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
        Schema::create('breeding_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('male_id')->constrained('crocodiles')->comment('父代雄性');
            $table->foreignId('female_id')->constrained('crocodiles')->comment('父代雌性');
            $table->date('mating_date')->comment('交配日期');
            $table->decimal('water_temp', 4, 1)->comment('水体温度(℃)');
            $table->decimal('air_temp', 4, 1)->comment('环境温度(℃)');
            $table->integer('egg_count')->comment('产卵数量');
            $table->date('hatch_date')->nullable()->comment('孵化日期');
            $table->integer('hatch_count')->nullable()->comment('孵化成功数');
            $table->text('environment_log')->nullable()->comment('环境参数记录');
            $table->timestamps();
            
            // 遗传分析索引
            $table->index(['male_id', 'female_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeding_records');
    }
};
