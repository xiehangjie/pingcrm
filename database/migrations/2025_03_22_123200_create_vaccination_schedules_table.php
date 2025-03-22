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
        Schema::create('vaccination_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crocodile_id')->constrained()->comment('接种鳄鱼');
            $table->string('vaccine_type')->comment('疫苗类型');
            $table->date('due_date')->comment('应接种日期');
            $table->date('actual_date')->nullable()->comment('实际接种日期');
            $table->foreignId('vaccinator_id')->constrained('users')->comment('接种人员');
            $table->text('notes')->nullable()->comment('接种备注');
            $table->timestamps();
            
            // 时效性索引
            $table->index(['due_date', 'actual_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_schedules');
    }
};
