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
abstract class AbstractUuidIdentity extends AbstractStringIdentity
{
    /**
     * @return string
     */
    protected static function generateRandomIdentity(): string
    {
        // @spalm-suppress UnsafeInstantiation
        return Uuid::uuid4()->toString();
    }

    /**
     * This is an example of the Template pattern, where this method is defined (templated) and used here,
     * but implemented in a subclass.
     *
     * @param string $id
     * @return bool
     */
    protected function isValid(string $id): bool
    {
        return (preg_match('`^[0-9a-f]{8}(-[0-9a-f]{4}){3}-[0-9a-f]{12}$`D', $id) === 1);
    }
}
