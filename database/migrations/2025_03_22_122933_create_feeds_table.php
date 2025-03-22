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
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('饲料名称');
            $table->string('qr_code')->unique()->comment('二维码标识');
            $table->string('batch_number')->comment('生产批次');
            $table->decimal('protein', 5, 2)->comment('蛋白质含量(%)');
            $table->decimal('fat', 5, 2)->comment('脂肪含量(%)');
            $table->decimal('fiber', 5, 2)->comment('纤维素含量(%)');
            $table->date('production_date')->comment('生产日期');
            $table->date('expiry_date')->comment('有效期至');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
