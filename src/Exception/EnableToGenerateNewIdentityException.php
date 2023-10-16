<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 13/12/2021
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract\Exception;

use JeckelLab\Contract\Domain\Identity\Exception\IdentityException;
use LogicException;

/**
 * Class EnableToGenerateNewIdentityException
 * @package JeckelLab\IdentityContract\Exception
 * @psalm-immutable
 * @psalm-suppress MutableDependency
 */
class EnableToGenerateNewIdentityException extends LogicException implements IdentityException {}
