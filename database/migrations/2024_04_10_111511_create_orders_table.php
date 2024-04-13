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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // ユーザーID
            $table->string('group_name'); // 団体名
            $table->string('order_purpose'); // 旅の目的
            $table->dateTime('start_date'); // 日時
            $table->dateTime('end_date'); // 日時
            $table->integer('order_number'); // 人数
            $table->integer('order_budget'); // 予算
            $table->string('order_area'); // 希望エリア
            $table->text('order_content'); // 募集する内容
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
