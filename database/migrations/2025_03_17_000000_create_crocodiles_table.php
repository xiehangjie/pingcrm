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
        Schema::create('crocodiles', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 100)->unique()->comment('唯一身份标识');
            $table->string('rfid_tag', 100)->unique()->comment('RFID标签');
            $table->string('species_type', 100)->comment('鳄鱼种类');
            $table->enum('gender', ['雄性', '雌性'])->comment('性别');
            $table->date('birth_date')->comment('出生日期');
            $table->string('genetic_lineage', 255)->comment('遗传谱系');
            $table->foreignId('father_id')->nullable()->constrained('crocodiles');
            $table->foreignId('mother_id')->nullable()->constrained('crocodiles');
            $table->string('batch_number')->comment('繁殖批次号');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crocodiles');
    }
};
