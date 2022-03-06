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
        Schema::create('user_score', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->on('users')->cascadeOnDelete();
            $table->foreignId('score_id')->constrained()->on('scores')->cascadeOnDelete();
            $table->integer('board_number');
            $table->primary(['user_id', 'board_number'], 'unique_user_board_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_score');
    }
};
