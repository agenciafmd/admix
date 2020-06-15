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
    }
}