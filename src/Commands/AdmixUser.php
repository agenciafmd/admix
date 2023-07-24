<?php

namespace Agenciafmd\Admix\Commands;

use Agenciafmd\Admix\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdmixUser extends Command
{
    protected $signature = 'admix:user';

    protected $description = 'Cria um novo usuário';

    public function handle(): void
    {
        $name = $this->ask('Nome');
        $email = $this->ask('Email');
        $password = $this->secret('Senha');
        $password = Hash::make($password);

        User::query()
            ->updateOrCreate([
                'email' => $email
            ], [
                'name' => $name,
                'password' => $password,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

        $this->info('Usuário criado');
        $this->line($name . ' (' . $email . ')' . "\n");
    }
}
