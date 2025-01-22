<?php

if (!function_exists('flash')) {
    function flash(string $message, string $level = 'info'): void
    {
        session()->flash('flash_notification', collect([
            'level' => $level,
            'message' => $message,
        ]));
    }
}
