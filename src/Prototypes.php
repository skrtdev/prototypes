<?php

namespace skrtdev\Prototypes;

use Closure, Error;

class Prototypes {

    use Prototypeable;

    protected static array $methods = [];
    protected static array $classes = [];

    public static function isPrototypeable(string $class_name): bool
    {
        return self::$classes[$class_name] ??= in_array(Prototypeable::class, self::getClassTraits($class_name));
    }

    public static function addClassMethod(string $class_name, string $name, Closure $fun): void
    {
        if(self::isPrototypeable($class_name)){
            if(!method_exists($class_name, $name)){
                self::$methods[$class_name] ??= [];
                if(!isset(self::$methods[$class_name][$name])){
                    self::$methods[$class_name][$name] = $fun;
                }
                else{
                    throw new Exception("Invalid method name provided for class '$class_name': method '$name' is already a Prototype");
                }
            }
            else{
                throw new Exception("Invalid method name provided for class '$class_name': method '$name' already exists");
            }
        }
        else{
            throw new Exception("Invalid class provided: class '$class_name' is not Prototypeable");
        }
    }

    public static function call(object $obj, string $name, array $args)
    {
        $class_name = get_class($obj);
        self::$methods[$class_name] ??= [];
        if(isset(self::$methods[$class_name][$name])){
            $closure = self::$methods[$class_name][$name];
            return $closure->call($obj, ...$args);
        }
        else{
            throw new Error("Call to undefined method $class_name::$name()");
        }
    }

    protected static function getClassTraits(string $class): array
    {
        if(!class_exists($class)){
            throw new Exception("Class $class does not exist");
        }
        $traits = [];
        do {
            $traits = array_merge(class_uses($class), $traits);
        }
        while($class = get_parent_class($class));

        foreach ($traits as $trait) {
            $traits = array_merge(class_uses($trait), $traits);
        }

        return array_unique(array_values($traits));
    }

}

?>
