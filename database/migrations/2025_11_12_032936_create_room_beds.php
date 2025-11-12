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
        Schema::create('room_beds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_id')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            # room status [available, occupied, maintenance]
            $table->string('status');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('room_beds');
    }
};
