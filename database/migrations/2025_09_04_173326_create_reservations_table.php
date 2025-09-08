<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->date('checkin');
        $table->date('checkout');
        $table->string('room');
        $table->string('status')->default('pending'); // pending, accepted, refused, waiting
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
