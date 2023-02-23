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
        Schema::create('permission_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreignUuid('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->boolean('add_access')->default(1);
            $table->boolean('edit_access')->default(1);
            $table->boolean('delete_access')->default(1);
            $table->boolean('view_access')->default(1);
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_modules');
    }
};
