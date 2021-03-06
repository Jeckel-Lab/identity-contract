<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 09/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use Ramsey\Uuid\Uuid;

/**
 * Class UuidIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @template-extends IdentityAbstract<string>
 * @psalm-immutable
 */
abstract class UuidIdentityAbstract extends IdentityAbstract
{
    /**
     * @return static
     * @spalm-suppress UnsafeInstantiation
     */
    final public static function new(): self
    {
        return new static(Uuid::uuid4()->toString());
    }

    /**
     * This is an example of the Template pattern, where this method is defined (templated) and used here,
     * but implemented in a subclass.
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValid(mixed $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        return (preg_match('`^[0-9a-f]{8}(-[0-9a-f]{4}){3}-[0-9a-f]{12}$`Di', $value) === 1);
    }

    /**
     * @return string
     */
    public function toScalar(): string
    {
        return $this->id;
    }
}
