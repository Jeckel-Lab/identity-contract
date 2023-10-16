<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 09/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\IdentityContract\Exception\EnableToGenerateNewIdentityException;

/**
 * Class IntIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @extends AbstractIdentity<int>
 * @psalm-immutable
 */
abstract readonly class AbstractIntIdentity extends AbstractIdentity
{
    /**
     * @return int|string
     * @psalm-return int
     */
    protected static function generateNewIdentity(): int|string
    {
        throw new EnableToGenerateNewIdentityException();
    }

    /**
     * @param int|string $id
     * @psalm-param int $id
     * @return bool
     * @psalm-suppress RedundantCondition
     */
    public function isValid(int|string $id): bool
    {
        return is_int($id) && $id > 0;
    }
}
