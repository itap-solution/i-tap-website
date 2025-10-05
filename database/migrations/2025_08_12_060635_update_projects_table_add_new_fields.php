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
        Schema::table('projects', function (Blueprint $table) {
            // Rename existing fields to match new structure
            $table->renameColumn('title', 'project_name');
            $table->renameColumn('image', 'project_image');
            $table->renameColumn('description', 'project_description');

            // Add new fields
            $table->decimal('project_price', 10, 2)->nullable()->after('project_name');
            $table->decimal('project_discount', 5, 2)->nullable()->after('project_price'); // Percentage discount

            // Keep technologies as JSON field
            // Keep other existing fields as they are
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Revert field names
            $table->renameColumn('project_name', 'title');
            $table->renameColumn('project_image', 'image');
            $table->renameColumn('project_description', 'description');

            // Remove new fields
            $table->dropColumn(['project_price', 'project_discount']);
        });
    }
};
