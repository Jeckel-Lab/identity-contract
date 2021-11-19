<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Application\Domain\Identity\Identity;

/**
 * @template IdentityType
 * @psalm-immutable
 */
trait IdentityEqualityTrait
{
    /**
     * @param Identity<IdentityType> $other
     * @return bool
     * @psalm-suppress DocblockTypeContradiction
     */
    public function equalsTo($other): bool
    {
        if (! is_object($other)) {
            return false;
        }
        return get_class($other) === get_class($this) && $this->id() === $other->id();
    }
}
