<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 16/10/2023
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Domain\Identity\Identity;

/**
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 */
final class IdRepository
{
    /**
     * @var array<class-string<Identity<int|string>>, array<int|string, Identity<int|string>>>
     */
    private array $identities = [];

    private static function getInstance(): self
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new self();
        }
        return $instance;
    }

    public static function has(string $identityFqcn, int|string $id): bool
    {
        return isset(self::getInstance()->identities[$identityFqcn][$id]);
    }

    public static function get(string $identityFqcn, int|string $id): ?Identity
    {
        return self::has($identityFqcn, $id) ? self::getInstance()->identities[$identityFqcn][$id] : null;
    }

    public static function set(Identity $identity): Identity
    {
        self::getInstance()->identities[get_class($identity)][$identity->id()] = $identity;
        return $identity;
    }
}
