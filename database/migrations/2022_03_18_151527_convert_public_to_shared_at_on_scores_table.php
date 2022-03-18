<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->timestamp('shared_at')->nullable()->after('public');
            $table->dropColumn('public');
        });
    }
};
