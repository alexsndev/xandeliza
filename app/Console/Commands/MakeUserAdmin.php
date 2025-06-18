<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MakeUserAdmin extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Torna um usuário admin pelo email';

    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("Usuário com email {$email} não encontrado!");
            return;
        }
        
        $user->role = 'admin';
        $user->save();
        
        $this->info("Usuário {$email} agora é admin!");
    }
} 