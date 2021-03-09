<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 09/03/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract;

use JeckelLab\Contract\Domain\Equality;
use JeckelLab\Contract\Domain\Identity\Exception\InvalidIdException;
use JeckelLab\Contract\Domain\Identity\Identity;

/**
 * Class IdentityAbstract
 * @package JeckelLab\IdentityContract
 * @template T
 * @psalm-immutable
 */
abstract class IdentityAbstract implements Equality, Identity
{
    /**
     * @var T
     */
    protected $id;

    /**
     * IdAbstract constructor.
     * @param T $id
     */
    final public function __construct($id)
    {
        $this->validate($id);

        $this->id = $id;
    }

    /**
     * This is an example of the Template pattern, where this method is defined (templated) and used here,
     * but implemented in a subclass.
     *
     * @param T $value
     * @return bool
     */
    abstract protected function isValid($value): bool;

    /**
     * @return string|int
     */
    abstract public function toScalar();

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->toScalar();
    }

    /**
     * @return T|mixed
     */
    public function jsonSerialize()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return bool
     */
    public function equals($id): bool
    {
        return is_object($id)
            && \get_class($this) === \get_class($id)
            && $this->id === $id->id;
    }

    /**
     * @param T $id
     */
    protected function validate($id): void
    {
        if (!$this->isValid($id)) {
            throw new InvalidIdException((string) $id);
        }
    }
}
