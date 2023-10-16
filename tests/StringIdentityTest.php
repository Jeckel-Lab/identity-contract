<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

namespace Tests\JeckelLab\IdentityContract;

use JeckelLab\IdentityContract\IdRepository;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringCustomGeneratorIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringIdentity;
use PHPUnit\Framework\TestCase;
use stdClass;
use Throwable;

class StringIdentityTest extends TestCase
{
    public function testFromWithStringShouldSuccess(): void
    {
        $identity = FixtureStringIdentity::from('barfoo');
        self::assertEquals('barfoo', $identity->id());
        self::assertEquals('barfoo', (string) $identity);
        self::assertSame($identity, IdRepository::get(FixtureStringIdentity::class, 'barfoo'));
    }

    /**
     * @dataProvider notStringData
     * @param mixed $invalidId
     */
    public function testFromWithNotStringShouldFail(mixed $invalidId): void
    {
        $this->expectException(Throwable::class);
        /** @phpstan-ignore-next-line */
        FixtureStringIdentity::from($invalidId);
    }

    public function testNewShouldGenerateRandomId(): void
    {
        $id1 = FixtureStringIdentity::new();
        $id2 = FixtureStringIdentity::new();
        self::assertNotEquals($id1->id(), $id2->id());

        $customId = FixtureStringCustomGeneratorIdentity::new();
        self::assertNotEquals($id1->id(), $customId->id());
        self::assertNotEquals(get_class($customId), get_class($id2));
    }

    public function testIdReturnTheProvidedId(): void
    {
        self::assertSame('foobar', FixtureStringIdentity::from('foobar')->id());
    }

    public function testStringifyReturnTheProvidedIdAsString(): void
    {
        self::assertSame('foobar', (string) FixtureStringIdentity::from('foobar'));
    }

    public function testEqualsWithSameIdShouldSuccess(): void
    {
        $id1 = FixtureStringIdentity::from('foobar');
        $id2 = FixtureStringIdentity::from('foobar');

        self::assertSame($id1, $id2);
        self::assertTrue($id1->equals($id1));
        self::assertTrue($id1->equals($id2));

        self::assertFalse($id1->equals(FixtureStringIdentity::from('foobarbaz')));
        self::assertFalse($id1->equals(FixtureIntIdentity::from(123)));
    }

    /**
     * @param mixed $id
     * @return void
     * @dataProvider notStringData
     */
    public function testEqualsWithDifferentIdShouldFail(mixed $id): void
    {
        $id1 = FixtureStringIdentity::from('foobar');
        self::assertFalse($id1->equals($id));
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function testJsonSerialization(): void
    {
        self::assertEquals(
            '"foobar"',
            json_encode(FixtureStringIdentity::from('foobar'), JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @return list<list<mixed>>
     */
    public static function notStringData(): array
    {
        return [
            [null],
            [123],
            [true],
            [false],
            [[123, 1254]],
            [new stdClass()]
        ];
    }
}
