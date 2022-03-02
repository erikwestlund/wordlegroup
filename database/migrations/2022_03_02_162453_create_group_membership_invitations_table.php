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
        Schema::create('group_membership_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->on('groups');
            $table->foreignId('user_id')->constrained()->on('users');
            $table->string('email')->nullable();
            $table->string('token', 100)->nullable();
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
        Schema::dropIfExists('group_membership_invitations');
    }
};
