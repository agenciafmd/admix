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

        if (User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'type' => 'admix'
        ])) {
            $this->info('Usuário criado');
            $this->line($name . ' (' . $email . ')' . "\n");
        }
    }
}
