<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 09/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

/**
 * Class IntIdentityAbstract
 * @package JeckelLab\IdentityContract
 * @template-extends IdentityAbstract<int>
 * @psalm-immutable
 */
abstract class IntIdentityAbstract extends IdentityAbstract
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function toScalar(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isValid($value): bool
    {
        return is_int($value) && $value > 0;
    }
}
