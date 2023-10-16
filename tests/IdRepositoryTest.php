<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 16/10/2023
 */

declare(strict_types=1);

use JeckelLab\IdentityContract\IdRepository;
use PHPUnit\Framework\TestCase;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;

class IdRepositoryTest extends TestCase
{
    public function testAddingNewIdentityShouldMakeItAvailableLater(): void
    {
        $identity = FixtureIntIdentity::from(123);

        self::assertTrue(IdRepository::has(FixtureIntIdentity::class, 123));
        self::assertSame($identity, IdRepository::get(FixtureIntIdentity::class, 123));
    }
}
