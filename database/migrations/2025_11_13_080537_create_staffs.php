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
        Schema::create('staffs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('job_position_id')->nullable();
            $table->uuid('job_department_id')->nullable();
            $table->string('employee_number')->unique();
            $table->string('full_name');
            $table->date('birth_date')->nullable();
            # gender [male, female]
            $table->string('gender');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('join_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_position_id')
                ->references('id')
                ->on('job_positions')
                ->onDelete('set null');
            $table->foreign('job_department_id')
                ->references('id')
                ->on('job_departments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
