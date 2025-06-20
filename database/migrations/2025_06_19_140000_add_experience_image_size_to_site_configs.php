<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        \DB::table('site_configs')->insert([
            'key' => 'experience_image_size',
            'value' => '32',
            'label' => 'Tamanho das imagens da sessão de experiências',
            'type' => 'text',
            'group' => 'experiences',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public function down() {
        \DB::table('site_configs')->where('key', 'experience_image_size')->delete();
    }
}; 