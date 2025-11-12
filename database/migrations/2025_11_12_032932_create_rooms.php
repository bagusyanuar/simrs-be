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
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('hospital_unit_id')->nullable();
            $table->uuid('room_class_id')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('floor')->nullable();
            # genders [male, female, mixed]
            $table->string('gender');
            $table->boolean('is_isolation')->default(false);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hospital_unit_id')
                ->references('id')
                ->on('hospital_units')
                ->onDelete('set null');

            $table->foreign('room_class_id')
                ->references('id')
                ->on('room_classes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
