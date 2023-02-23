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
        Schema::create('modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('module_code',7);
            $table->string('name',64);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_in_menu')->default(1);
            $table->integer('display_order');
            $table->timestamps();
            $table->softDeletes('deleted_at');
            // $table->foreignUuid('created_by')->references('id')->on('users')->nullable();
            // $table->foreignUuid('updated_by')->references('id')->on('users')->nullable();
            // $table->timestamp('deleted_at');
            // $table->foreignUuid('deleted_by')->references('id')->on('users')->nullable();
            // $table->boolean('is_delete')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
