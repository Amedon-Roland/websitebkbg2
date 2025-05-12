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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_category_id')->constrained()->onDelete('cascade');
            $table->integer('guests');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->text('special_requests')->nullable();
            $table->boolean('breakfast')->default(false);
            $table->boolean('late_checkout')->default(false);
            $table->boolean('airport_transfer')->default(false);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
