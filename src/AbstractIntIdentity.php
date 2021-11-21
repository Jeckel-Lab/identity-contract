<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 09/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Application\Domain\Identity\Exception\EnableToGenerateNewIdentityException;
use JeckelLab\Contract\Application\Domain\Identity\Identity;

/**
 * Class IntIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @implements Identity<int>
 * @psalm-immutable
 */
abstract class AbstractIntIdentity implements Identity
{
    /**
     * @use IdentityEqualityTrait<int>
     */
    use IdentityEqualityTrait;

    private int $identity;

    final private function __construct(int $id)
    {
        $this->identity = $id;
    }

    public function id()
    {
        return $this->identity;
    }

    /**
     * @return AbstractIntIdentity
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public static function new()
    {
        throw new EnableToGenerateNewIdentityException();
    }

    /**
     * @param int $id
     * @return AbstractIntIdentity
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public static function from($id)
    {
        return new static($id);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->identity;
    }
}
