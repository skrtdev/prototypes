<?php

namespace skrtdev\Prototypes;

use Closure;

trait Prototypeable{

    public function __call(string $name, array $args){
        return Prototypes::call($this, $name, $args);
    }

    final public static function addMethod(string $name, Closure $fun){
        return Prototypes::addClassMethod(static::class, $name, $fun);
    }
}

?>
