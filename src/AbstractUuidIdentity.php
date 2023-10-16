<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use Ramsey\Uuid\Uuid;

/**
 * Class AbstractUuidIdentity
 * @package JeckelLab\IdentityContract
 * @psalm-immutable
 */
abstract readonly class AbstractUuidIdentity extends AbstractStringIdentity
{
    /**
     * @return string
     */
    protected static function generateNewIdentity(): string
    {
        // @spalm-suppress UnsafeInstantiation
        return Uuid::uuid4()->toString();
    }

    /**
     * @param int|string $id
     * @psalm-param string $id
     * @return bool
     * @psalm-suppress RedundantCast
     */
    public function isValid(int|string $id): bool
    {
        if (is_int($id)) {
            return false;
        }
        return (preg_match('`^[0-9a-f]{8}(-[0-9a-f]{4}){3}-[0-9a-f]{12}$`D', $id) === 1);
    }
}
