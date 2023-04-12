<?php

namespace App\Collections;

use Illuminate\Support\Collection;

class MyCollection extends Collection
{
    public function offsetGet($key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }
}