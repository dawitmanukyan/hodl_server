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
        Schema::create('airdrops', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('name');
            $table->string('symbol');
            $table->text('description');
            $table->string('link');
            $table->string('reward');
            $table->date('end_date');
            $table->string('website')->nullable();
            $table->string('telegram');
            $table->string('twitter')->nullable();
            $table->string('discord')->nullable();
            $table->string('reddit')->nullable();
            $table->string('audit')->nullable();
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
        Schema::dropIfExists('airdrops');
    }
};
