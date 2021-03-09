<?php

namespace Agenciafmd\Admix\Services\Contracts;

abstract class BaseService
{
    public function __construct()
    {
        $this->bootTraits();
    }

    private function bootTraits()
    {
        $traits = class_uses(static::class);

        foreach ($traits as $trait) {
            if (method_exists($trait, 'boot' . class_basename($trait))) {
                $this->{'boot' . class_basename($trait)}();
            }
        }
    }
}
