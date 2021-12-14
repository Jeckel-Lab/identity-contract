<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 13/12/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Domain\Equality;
use JeckelLab\Contract\Domain\Identity\Exception\InvalidIdException;
use JeckelLab\Contract\Domain\Identity\Identity;

/**
 * Class AbstractIdentity
 * @package JeckelLab\IdentityContract
 * @template IdentityType of int|string
 * @implements Identity<IdentityType>
 * @psalm-immutable
 */
abstract class AbstractIdentity implements Identity
{
    /**
     * @var array<class-string<Identity<int|string>>, array<string|int, Identity<int|string>>>
     */
    private static array $instances = [];

    /**
     * @var IdentityType
     */
    private string|int $identity;

    /**
     * @param int|string $id
     * @psalm-param IdentityType $id
     */
    final private function __construct(int|string $id)
    {
        if (! $this->isValid($id)) {
            throw new InvalidIdException(sprintf('Invalid id %s provided', $id));
        }
        $this->identity = $id;
    }

    /**
     * @param int|string $identity
     * @return static
     */
    public static function from(int|string $identity): static
    {
        if (isset(self::$instances[static::class][$identity])) {
            /** @var static $instance */
            $instance = self::$instances[static::class][$identity];
            return $instance;
        }

        /** @psalm-suppress UnsafeGenericInstantiation */
        return self::$instances[static::class][$identity] = new static($identity);
    }

    /**
     * @return static
     */
    public static function new(): static
    {
        $identity = static::generateNewIdentity();
        /** @psalm-suppress UnsafeGenericInstantiation */
        return self::$instances[static::class][$identity] = new static($identity);
    }

    /**
     * @param int|string $id
     * @psalm-param IdentityType $id
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @infection-ignore-all
     */
    public function isValid(int|string $id): bool
    {
        // @codeCoverageIgnoreStart
        return true;
        // @codeCoverageIgnoreEnd
    }

    /**
     * @return int|string
     * @psalm-return IdentityType
     */
    abstract protected static function generateNewIdentity(): int|string;

    /**
     * @param mixed $other
     * @return bool
     */
    public function equals(mixed $other): bool
    {
        return $this === $other;
    }

    /**
     * @return int|string
     * @psalm-return IdentityType
     */
    public function id(): int|string
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->identity;
    }

    /**
     * @return int|string
     */
    public function jsonSerialize(): int|string
    {
        return $this->identity;
    }
}
