<?php

namespace Agenciafmd\Admix\Services\Models\Concerns;

trait HasAttributes
{
    /** 
     * Attributes transformed in the constructor.
     * 
     * @var mixed[]
     */
    public $attributes;

    /** 
     * Original attributes received from the constructor.
     * 
     * @var mixed[]
     */
    public $original;

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($value)
    {
        return $this->attributes[$value] ?? null;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    public function setAttribute($field, $value)
    {
        $this->attributes[$field] = $value;
    }
}