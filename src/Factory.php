<?php declare(strict_types=1);
/*
 * This file is part of Aplus Framework Factories Library.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Framework\Factories;

/**
 * Class Factory.
 *
 * @package factories
 */
class Factory
{
    /**
     * @var array<string,object>
     */
    protected array $classes = [];
    /**
     * @var array<string,Factory>
     */
    protected static array $factories = [];

    /**
     * @template T of object
     *
     * @param class-string<T> $fqcn
     *
     * @return T|null
     */
    public function get(string $fqcn) : object|null
    {
        return $this->classes[$fqcn] ?? null; // @phpstan-ignore-line
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $fqcn
     * @param array<int,mixed> $construct
     *
     * @return T
     */
    public function new(string $fqcn, array $construct = []) : object
    {
        return $this->classes[$fqcn] = new $fqcn(...$construct);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $fqcn
     * @param array<int,mixed> $construct
     *
     * @return T
     */
    public function getOrNew(string $fqcn, array $construct = []) : object
    {
        return $this->get($fqcn) ?? $this->new($fqcn, $construct);
    }

    public function set(object $class) : object
    {
        return $this->classes[$class::class] = $class;
    }

    public static function getFactory(string $name = 'default') : Factory
    {
        return self::$factories[$name]
            ?? (self::$factories[$name] = new self());
    }
}
