<?php

namespace Tests\JeckelLab\IdentityContract\Fixtures;

use JeckelLab\IdentityContract\AbstractStringIdentity;

class FixtureStringCustomGeneratorIdentity extends AbstractStringIdentity
{
    protected static function generateRandomIdentity(): string
    {
        return 'FOOBAR' . md5(microtime(false)) . 'BARFOO';
    }
}
