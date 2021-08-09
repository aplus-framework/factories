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

final class FactoryTest extends TestCase
{
    protected Factory $factory;

    protected function setUp() : void
    {
        $this->factory = new Factory();
    }

    public function testSample() : void
    {
        self::assertSame(
            'Framework\Factories\Factory::test',
            $this->factory->test()
        );
    }
}
