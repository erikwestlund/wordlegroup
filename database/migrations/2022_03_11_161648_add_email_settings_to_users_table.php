<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('allow_digest_emails')->after('public_profile')->default(0);
            $table->boolean('allow_reminder_emails')->after('allow_digest_emails')->default(0);
        });
    }
};
