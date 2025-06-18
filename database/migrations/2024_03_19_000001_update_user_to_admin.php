<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Atualiza o primeiro usuário para admin
        DB::table('users')
            ->where('id', 1)
            ->update(['role' => 'admin']);
    }

    public function down()
    {
        // Reverte para user
        DB::table('users')
            ->where('id', 1)
            ->update(['role' => 'user']);
    }
}; 