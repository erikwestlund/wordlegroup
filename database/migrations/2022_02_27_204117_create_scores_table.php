<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->on('users')->cascadeOnDelete();
            $table->foreignId('recording_user_id')->constrained()->on('users');
            $table->date('date');
            $table->integer('board_number');
            $table->unsignedSmallInteger('score');
            $table->boolean('hard_mode')->default(false);
            $table->text('board')->nullable();
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
        Schema::dropIfExists('scores');
    }
};
