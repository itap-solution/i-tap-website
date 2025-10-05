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
        Schema::table('chat_responses', function (Blueprint $table) {
            $table->string('name')->nullable(); // اسم المستخدم
            $table->string('email')->nullable(); // إيميل المستخدم
            $table->string('phone')->nullable(); // رقم الهاتف
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_responses', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone']);
        });
    }
};
