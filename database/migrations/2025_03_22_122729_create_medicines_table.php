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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('药品名称');
            $table->string('batch_number')->comment('生产批号');
            $table->date('expiry_date')->comment('有效期至');
            $table->decimal('stock', 8, 2)->comment('库存量');
            $table->string('unit')->default('ml')->comment('计量单位');
            $table->text('usage_instructions')->nullable()->comment('使用说明');
            $table->timestamps();

            // 有效期索引
            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
