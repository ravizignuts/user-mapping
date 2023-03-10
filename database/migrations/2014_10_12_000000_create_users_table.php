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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name',51);
            $table->string('last_name',51)->nullable();
            $table->string('email',51)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',251);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_first_login')->default(1);
            $table->char('code',6);
            $table->enum('type', ['superadmin', 'admin', 'user'])->default('user');
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->boolean('is_delete')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
