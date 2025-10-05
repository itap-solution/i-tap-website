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
            $table->string('mobile_platform')->nullable(); // iOS, Android, or Both
            $table->text('mobile_features')->nullable(); // Main features wanted
            $table->string('mobile_integration')->nullable(); // Integration needs
            $table->string('mobile_design_handling')->nullable(); // UI/UX design handling
            $table->string('mobile_budget_timeline')->nullable(); // Budget or timeline preference
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_responses', function (Blueprint $table) {
            $table->dropColumn(['mobile_platform', 'mobile_features', 'mobile_integration', 'mobile_design_handling', 'mobile_budget_timeline']);
        });
    }
};
