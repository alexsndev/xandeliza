<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('site_configs')->insert([            'key' => 'public_header_color',
            'value' => '#2c3e50', // Cor padrão do header público
            'label' => 'Cor do Header da Página Pública',
            'type' => 'color',
            'section' => 'general',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('site_configs')->where('key', 'header_color')->delete();
    }
};
