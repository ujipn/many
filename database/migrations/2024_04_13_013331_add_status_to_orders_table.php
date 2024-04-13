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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('accommodation_status')->default('unconfirmed');
            $table->string('activity_status')->default('unconfirmed');
            $table->string('content_status')->default('unconfirmed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('accommodation_status');
            $table->dropColumn('activity_status');
            $table->dropColumn('content_status');
        });
    }
};
