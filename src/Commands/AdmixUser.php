<?php

namespace Agenciafmd\Admix\Commands;

use Agenciafmd\Admix\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AdmixUser extends Command
{
    protected $signature = 'admix:user';

    protected $description = 'Cria um novo usuário';

    public function handle()
    {
        $name = $this->ask('Nome');
        $email = $this->ask('Email');
        $password = $this->secret('Senha');
        $password = Hash::make($password);

        if (User::updateOrCreate([
            'email' => $email,
            'type' => 'admix',
        ], [
            'name' => $name,
            'password' => $password,
        ])) {
            $this->info('Usuário criado');
            $this->line($name . ' (' . $email . ')' . "\n");
        }
    }
}
