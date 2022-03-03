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
        Schema::create('group_membership_score', function (Blueprint $table) {
            $table->foreignId('group_membership_id')->constrained()->on('groups');
            $table->foreignId('score_id')->constrained()->on('scores');
            $table->integer('board_number');
            $table->primary(['group_membership_id', 'score_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_membership_score');
    }
};
