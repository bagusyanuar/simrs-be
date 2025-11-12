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
        Schema::create('room_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_id')->nullable();
            $table->string('tariff_code')->unique();
            $table->string('name');
            $table->decimal('price_per_day', 15, 2)->default(0);
            # insurance type [GENERAL, BPJS, INSURANCE, CORPORATE]
            $table->string('insurance_type')->nullable();
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_rates');
    }
};
