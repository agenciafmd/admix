<?php

namespace Agenciafmd\Admix\Services\Models;

use ArrayAccess;

abstract class Model implements ArrayAccess
{
    use Concerns\HasAttributes;

    public function __get($value)
    {
        return $this->getAttribute($value);
    }

    public function __set($field, $value)
    {
        return $this->setAttribute($field, $value);
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return ! is_null($this->getAttribute($offset));
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        return $this->setAttribute($offset, $value);
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }
}