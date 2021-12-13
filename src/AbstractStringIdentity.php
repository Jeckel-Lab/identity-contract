<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 17/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

/**
 * Class StringIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @extends AbstractIdentity<string>
 * @psalm-immutable
 */
abstract class AbstractStringIdentity extends AbstractIdentity
{
    protected static function generateNewIdentity(): int|string
    {
        return md5(microtime(false));
    }

    /**
     * @param int|string $id
     * @psalm-param string $id
     * @return bool
     * @psalm-suppress RedundantCondition
     */
    public function isValid(int|string $id): bool
    {
        return is_string($id);
    }
}
