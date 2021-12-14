<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

namespace Tests\JeckelLab\IdentityContract;

use JeckelLab\IdentityContract\Exception\EnableToGenerateNewIdentityException;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringIdentity;
use PHPUnit\Framework\TestCase;
use stdClass;
use Throwable;

/**
 * Class IntIdentityTest
 * @package Tests\JeckelLab\IdentityContract
 * @psalm-suppress PropertyNotSetInConstructor
 */
class IntIdentityTest extends TestCase
{
    public function testFromWithIntShouldSuccess(): void
    {
        $this->assertInstanceOf(FixtureIntIdentity::class, FixtureIntIdentity::from(25));
    }

    /**
     * @dataProvider notIntData
     * @param mixed $invalidId
     */
    public function testFromWithNotIntShouldFail($invalidId): void
    {
        $this->expectException(Throwable::class);
        FixtureIntIdentity::from($invalidId);
    }

    public function testNewShouldFail(): void
    {
        $this->expectException(EnableToGenerateNewIdentityException::class);
        FixtureIntIdentity::new();
    }

    public function testIdReturnTheProvidedId(): void
    {
        $this->assertSame(123, FixtureIntIdentity::from(123)->id());
    }

    public function testStringifyReturnTheProvidedIdAsString(): void
    {
        $this->assertSame('123', (string) FixtureIntIdentity::from(123));
    }

    public function testEqualsWithSameIdShouldSuccess(): void
    {
        $id1 = FixtureIntIdentity::from(123);
        $id2 = FixtureIntIdentity::from(123);

        $this->assertSame($id1, $id2);
        $this->assertTrue($id1->equals($id1));
        $this->assertTrue($id1->equals($id2));

        // Test with same class
        $this->assertFalse($id1->equals(FixtureIntIdentity::from(124)));
        $this->assertFalse($id1->equals(FixtureStringIdentity::from('Foobar')));
    }

    /**
     * @param mixed $id
     * @return void
     * @dataProvider notIntData
     */
    public function testEqualsWithDifferentIdShouldFail(mixed $id): void
    {
        $id1 = FixtureIntIdentity::from(123);
        $this->assertFalse($id1->equals($id));
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function testJsonSerialization(): void
    {
        $this->assertEquals(
            123,
            json_encode(FixtureIntIdentity::from(123), JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @return list<list<mixed>>
     */
    public function notIntData(): array
    {
        return [
            [null],
            ['1213'],
            ['bjkblk'],
            [false],
            [[123, 1254]],
            [new stdClass()]
        ];
    }

}
