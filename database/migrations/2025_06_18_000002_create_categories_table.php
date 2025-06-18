<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon_type')->default('svg'); // svg, png, code
            $table->text('icon_content'); // svg code ou caminho do png
            $table->string('stroke_color')->default('#111827');
            $table->string('icon_color')->default('#2563eb');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}; 