<?php

namespace Tests\JeckelLab\IdentityContract\Fixtures;

use JeckelLab\IdentityContract\AbstractStringIdentity;

/**
 * Class FixtureStringCustomGeneratorIdentity
 * @package Tests\JeckelLab\IdentityContract\Fixtures
 * @psalm-immutable
 */
readonly class FixtureStringCustomGeneratorIdentity extends AbstractStringIdentity
{
    protected static function generateRandomIdentity(): string
    {
        return 'FOOBAR' . md5(microtime(false)) . 'BARFOO';
    }
}
