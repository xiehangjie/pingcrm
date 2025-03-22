<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enclosures', function (Blueprint $table) {
            $table->id();
            $table->string('pool_id')->unique()->comment('池编号');
            $table->integer('capacity')->comment('最大容量');
            $table->string('pool_type', 100)->comment('池类型');
            $table->integer('current_count')->default(0)->comment('当前数量');
            $table->enum('status', ['normal', 'critical', 'overload'])
                ->default('normal')
                ->comment('状态');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enclosures');
    }
};
