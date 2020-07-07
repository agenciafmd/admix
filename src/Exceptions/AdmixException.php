<?php

namespace Agenciafmd\Admix\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class AdmixException extends Exception
{
    public function render($request)
    {
        flash($this->message, 'danger');

        return redirect()->back();
    }

    public function report()
    {
        Log::channel('admix')
            ->info("{$this->message} ({$this->file}:L{$this->line})");

        Log::channel('admix-slack')
            ->warning("{$this->message}", [
                'Site' => "[" . config('app.name') . "](" . config('app.url') . ")",
                'Arquivo' => $this->file,
                'Linha' => $this->line,
                'Responsável' => ':elephant:',
            ]);
    }
}