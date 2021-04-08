<?php

namespace Agenciafmd\Admix\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GuzzleRequestFailedEvent
{
    use Dispatchable,
        InteractsWithSockets,
        SerializesModels;
    
    public $exception;
    
    public function __construct($exception)
    {
        $this->exception = $exception;
    }
}