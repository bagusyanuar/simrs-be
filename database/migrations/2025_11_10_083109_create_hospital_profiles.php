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
        Schema::create('hospital_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('hospital_class')->nullable();
            $table->string('hospital_type')->nullable();
            $table->string('hospital_ownership')->nullable();
            $table->string('director')->nullable();
            $table->string('license_number')->nullable();
            $table->date('license_issued_date')->nullable();
            $table->text('address')->nullable();
            $table->string('province_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('district_name')->nullable();
            $table->string('village_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('bpjs_code')->nullable();
            $table->string('kemenkes_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_profiles');
    }
};
