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
 * @template-extends IdentityAbstract<string>
 * @psalm-immutable
 */
abstract class StringIdentityAbstract extends IdentityAbstract
{
    /**
     * @return string
     */
    public function toScalar(): string
    {
        return $this->id;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isValid(mixed $value): bool
    {
        return is_string($value) && $value !== '';
    }
}
