<?php

namespace skrtdev\PrototypesTests;

use Error;
use PHPUnit\Framework\TestCase;
use skrtdev\Prototypes\Exception;


class PrototypesTest extends TestCase
{
    public function testPrototypeCanBeCreated(): void
    {
        $this->assertNull(DemoClassTest::addMethod('prototypeMethod', fn() => $this->property));
    }

    public function testPrototypeCanBeCalled(): void
    {
        $this->assertTrue((new DemoClassTest)->prototypeMethod());
    }

    public function testErrorIsThrownInNonExistentMethods(): void
    {
        $this->expectException(Error::class);
        (new DemoClassTest)->nonExistentMethod();
    }

    public function testCantOverridePrototypes(): void
    {
        $this->expectException(Exception::class);
        DemoClassTest::addMethod('prototypeMethod', fn() => $this->property);
    }

    public function testCantOverrideMethods(): void
    {
        $this->expectException(Exception::class);
        DemoClassTest::addMethod('existentMethod', fn() => $this->property);
    }

    public function testCanUseCallable(): void
    {
        $this->assertNull(DemoClassTest::addMethod('unexistentMethod', 'file_get_contents'));
    }

}
