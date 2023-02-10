<?php declare (strict_types=1);

use Illuminate\Support\Collection;

final class Command extends Collection {

    public function push(mixed $value): self
    {
        $this->offsetSet(null, $value);
        
        return $this;
    }

}