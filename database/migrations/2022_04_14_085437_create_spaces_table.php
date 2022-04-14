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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('town_id')->constrained('towns')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');
            $table->foreignId('space_categories_id')->constrained('space_categories')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')
                                                ->onUpdate('cascade')
                                                ->onDelete('cascade');
            $table->string('district')->nullable();
            $table->string('phone')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
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
        Schema::dropIfExists('spaces');
    }
};
