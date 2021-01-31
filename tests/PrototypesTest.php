<?php

namespace skrtdev\Prototypes;

use PHPUnit\Framework\TestCase;

class DemoClass {
    use Prototypeable;

    public function existentMethod(): void
    {

    }
}

class PrototypesTest extends TestCase
{
    public function testPrototypeCanBeCreated(): void
    {
        $this->assertNull(DemoClass::addMethod('prototypeMethod', fn() => true));
    }

    public function testErrorIsThrownInNonExistentMethods(): void
    {
        $this->expectException(\Error::class);
        (new DemoClass)->nonExistentMethod();
    }

    public function testCantOverridePrototypes(): void
    {
        $this->expectException(Exception::class);
        DemoClass::addMethod('prototypeMethod', fn() => true);
    }

    public function testCantOverrideMethods(): void
    {
        $this->expectException(Exception::class);
        DemoClass::addMethod('existentMethod', fn() => true);
    }

    public function testNonExistentClass(): void
    {
        $this->expectException(Exception::class);
        Prototypes::addClassMethod('RandomClass', 'RandomMethod', fn() => true);
    }

    public function testNonPrototypeableClass(): void
    {
        $this->expectException(Exception::class);
        Prototypes::addClassMethod(\stdClass::class, 'RandomMethod', fn() => true);
    }
}
