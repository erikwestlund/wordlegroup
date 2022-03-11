<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('group_membership_invitations', function (Blueprint $table) {
            $table->timestamp('reminded_at')->nullable()->after('token');
        });
    }
};
