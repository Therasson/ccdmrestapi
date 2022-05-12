<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('space_id')->constrained('spaces')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('arrived_date');
            $table->date('departure_date');
            $table->integer('number_of_adults');
            $table->integer('number_of_children')->nullable();
            $table->string('phone');
            $table->string('status');
            $table->date('booked_at');
            $table->integer('etat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
