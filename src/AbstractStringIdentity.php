<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 17/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Application\Domain\Identity\Exception\InvalidIdentityArgumentException;
use JeckelLab\Contract\Application\Domain\Identity\Identity;

/**
 * Class StringIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @implements Identity<string>
 * @psalm-immutable
 */
abstract class AbstractStringIdentity implements Identity
{
    /**
     * @use IdentityEqualityTrait<string>
     */
    use IdentityEqualityTrait;

    private string $identity;

    final public function __construct($id)
    {
        if (! $this->isValid($id)) {
            throw new InvalidIdentityArgumentException(sprintf('Invalid id %s provided', $id));
        }
        $this->identity = $id;
    }

    /**
     * @param string|null $id
     * @return AbstractStringIdentity
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public static function new($id = null)
    {
        if (null === $id) {
            $id = static::generateRandomIdentity();
        }
        return new static($id);
    }

    /**
     * @param string $id
     * @return AbstractStringIdentity
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public static function from($id)
    {
        return new static($id);
    }

    /**
     * @param string $id
     * @return bool
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function isValid(string $id): bool
    {
        return true;
    }

    protected static function generateRandomIdentity(): string
    {
        return md5(microtime(false));
    }

    public function id()
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->identity;
    }
}
