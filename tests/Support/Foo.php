<?php
/*
 * This file is part of Aplus Framework Factories Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Factories\Support;

class Foo
{
    public mixed $arg;

    public function __construct(mixed $arg = null)
    {
        $this->arg = $arg;
    }
}
