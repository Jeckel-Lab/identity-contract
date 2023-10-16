<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 16/10/2023
 */

declare(strict_types=1);

namespace JeckelLab\IdentityContract\Exception;

use JeckelLab\Contract\Domain\Identity\Exception\IdentityException;
use LogicException;

class CloningException extends LogicException implements IdentityException {}
