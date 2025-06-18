<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('site_configs', function (Blueprint $table) {
            $table->string('section')->default('general')->after('type');
        });
    }

    public function down()
    {
        Schema::table('site_configs', function (Blueprint $table) {
            $table->dropColumn('section');
        });
    }
};
