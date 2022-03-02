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
        Schema::create('group_scores', function (Blueprint $table) {
            $table->foreignId('group_id')->constrained()->on('groups');
            $table->foreignId('recorder_user_id')->constrained()->on('users');
            $table->foreignId('score_id')->constrained()->on('scores');
            $table->primary(['group_id', 'score_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_scores_pivot');
    }
};
