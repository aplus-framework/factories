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
     * All class objects set in the current Factory.
     *
     * @var array<string,object>
     */
    protected array $classes = [];
    /**
     * Factory instances.
     *
     * @var array<string,Factory>
     */
    protected static array $factories = [];

    /**
     * Get an object based in the FQCN.
     *
     * @template T of object
     *
     * @param class-string<T> $fqcn The Full Qualified Class Name
     *
     * @return T|null The FQCN object or null if it was not set
     */
    public function get(string $fqcn) : object|null
    {
        return $this->classes[$fqcn] ?? null; // @phpstan-ignore-line
    }

    /**
     * Create a new object based on the FQCN.
     *
     * This method will replace the class instance.
     *
     * @template T of object
     *
     * @param class-string<T> $fqcn The Full Qualified Class Name
     * @param array<int,mixed> $construct Class constructor arguments
     *
     * @return T The created object
     */
    public function new(string $fqcn, array $construct = []) : object
    {
        return $this->classes[$fqcn] = new $fqcn(...$construct);
    }

    /**
     * Try to get an existing class instance based on FQCN.
     * If it is not set, create a new instance and return it.
     *
     * @template T of object
     *
     * @param class-string<T> $fqcn The Full Qualified Class Name
     * @param array<int,mixed> $construct Class constructor arguments
     *
     * @return T The existing or created object
     */
    public function getOrNew(string $fqcn, array $construct = []) : object
    {
        return $this->get($fqcn) ?? $this->new($fqcn, $construct);
    }

    /**
     * Set a new object to the list of classes set.
     *
     * @param object $object A object
     *
     * @return static
     */
    public function set(object $object) : static
    {
        $this->classes[$object::class] = $object;
        return $this;
    }

    /**
     * Get (existing or created) Factory instance based on a custom name.
     *
     * @param string $name The Factory name
     *
     * @return Factory The Factory instance
     */
    public static function getFactory(string $name = 'default') : Factory
    {
        return self::$factories[$name]
            ?? (self::$factories[$name] = new self());
    }
}
