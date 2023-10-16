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
use JeckelLab\IdentityContract\Exception\CloningException;

/**
 * Class AbstractIdentity
 * @package JeckelLab\IdentityContract
 * @template IdentityType of int|string
 * @implements Identity<IdentityType>
 * @psalm-immutable
 */
abstract readonly class AbstractIdentity implements Identity
{
    /**
     * @var IdentityType
     */
    private string|int $identity;

    /**
     * @psalm-param IdentityType $id
     */
    final private function __construct(int|string $id)
    {
        if (! $this->isValid($id)) {
            throw new InvalidIdException(sprintf('Invalid id %s provided', $id));
        }
        $this->identity = $id;
    }

    public static function from(int|string $identity): static
    {
        if (IdRepository::has(static::class, $identity)) {
            /** @var static $identityInstance */
            $identityInstance = IdRepository::get(static::class, $identity);
            return $identityInstance;
        }
        $identityInstance = new static($identity);
        IdRepository::set($identityInstance);
        return $identityInstance;
    }

    /**
     * @return static
     */
    public static function new(): static
    {
        $id = static::generateNewIdentity();
        $identity = new static($id);
        IdRepository::set($identity);
        return $identity;
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

    public function __clone(): void
    {
        throw new CloningException("Cloning identity is not allowed");
    }

    /**
     * @return int|string
     */
    public function jsonSerialize(): int|string
    {
        return $this->identity;
    }
}
