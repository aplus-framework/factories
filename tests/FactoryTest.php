<?php
/*
 * This file is part of Aplus Framework Factories Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Factories;

use Framework\Factories\Factory;
use PHPUnit\Framework\TestCase;
use Tests\Factories\Support\Foo;

final class FactoryTest extends TestCase
{
    protected Factory $factory;

    protected function setUp() : void
    {
        $this->factory = new Factory();
    }

    public function testGetNull() : void
    {
        self::assertNull($this->factory->get(Foo::class));
    }

    public function testSetGet() : void
    {
        $foo = new Foo();
        $this->factory->set($foo);
        self::assertSame($foo, $this->factory->get(Foo::class));
    }

    public function testNew() : void
    {
        self::assertNull($this->factory->get(Foo::class));
        $this->factory->new(Foo::class);
        $foo = $this->factory->get(Foo::class);
        self::assertInstanceOf(Foo::class, $foo);
        self::assertNull($foo->arg);
        $this->factory->new(Foo::class, ['bar']);
        $foo = $this->factory->get(Foo::class);
        self::assertInstanceOf(Foo::class, $foo);
        self::assertSame('bar', $foo->arg);
    }

    public function testGetOrNew() : void
    {
        $foo = $this->factory->getOrNew(Foo::class);
        self::assertInstanceOf(Foo::class, $foo);
        self::assertSame($foo, $this->factory->getOrNew(Foo::class, ['bar']));
        $newFoo = $this->factory->new(Foo::class, ['bar']);
        self::assertInstanceOf(Foo::class, $newFoo);
        self::assertNotSame($foo, $newFoo);
    }

    public function testGetFactory() : void
    {
        $factory = Factory::getFactory();
        self::assertInstanceOf(Factory::class, $factory);
        self::assertSame($factory, Factory::getFactory());
        $otherFactory = Factory::getFactory('other');
        self::assertNotSame($factory, $otherFactory);
        self::assertSame($otherFactory, Factory::getFactory('other'));
    }
}
