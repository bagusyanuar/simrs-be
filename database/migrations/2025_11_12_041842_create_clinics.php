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
        Schema::create('clinics', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('hospital_unit_id')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('alias')->nullable();
            # type [POLYCLINIC, DEPARTMENT]
            $table->string('type');
            $table->string('bpjs_mapping_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hospital_unit_id')
                ->references('id')
                ->on('hospital_units')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
