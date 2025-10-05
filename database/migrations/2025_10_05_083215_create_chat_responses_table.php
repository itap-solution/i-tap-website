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
        Schema::create('chat_responses', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable(); // لتتبع جلسة المحادثة
            $table->string('service_type')->nullable(); // نوع الخدمة المختارة
            $table->string('project_goal')->nullable(); // هدف المشروع
            $table->string('design_status')->nullable(); // حالة التصميم
            $table->string('integration_needed')->nullable(); // الحاجة للتكامل
            $table->string('timeline')->nullable(); // الجدول الزمني
            $table->string('budget')->nullable(); // الميزانية
            $table->text('additional_message')->nullable(); // أي رسالة إضافية من المستخدم
            $table->string('ip_address')->nullable(); // عنوان IP
            $table->string('user_agent')->nullable(); // معلومات المتصفح
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_responses');
    }
};
