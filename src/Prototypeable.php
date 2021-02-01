<?php

namespace skrtdev\Prototypes;

use Closure;

trait Prototypeable{

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call(string $name, array $args)
    {
        return Prototypes::call($this, $name, $args);
    }

    /**
     * @param string $name
     * @param Closure $fun
     * @throws Exception
     */
    final public static function addMethod(string $name, Closure $fun): void
    {
        Prototypes::addClassMethod(static::class, $name, $fun);
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic(string $name, array $args)
    {
        return Prototypes::callStatic(static::class, $name, $args);
    }

    /**
     * @param string $name
     * @param Closure $fun
     * @throws Exception
     */
    final public static function addStaticMethod(string $name, Closure $fun): void
    {
        Prototypes::addClassStaticMethod(static::class, $name, $fun);
    }
}

