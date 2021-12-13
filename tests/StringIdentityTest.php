<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

namespace Tests\JeckelLab\IdentityContract;

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
        $this->assertInstanceOf(FixtureStringIdentity::class, FixtureStringIdentity::from('barfoo'));
    }

    /**
     * @dataProvider notStringData
     * @param $invalidId
     */
    public function testFromWithNotStringShouldFail($invalidId): void
    {
        $this->expectException(Throwable::class);
        FixtureStringIdentity::from($invalidId);
    }

    public function testNewShouldGenerateRandomId(): void
    {
        $id1 = FixtureStringIdentity::new();
        $this->assertInstanceOf(FixtureStringIdentity::class, $id1);

        $id2 = FixtureStringIdentity::new();
        $this->assertInstanceOf(FixtureStringIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());

        $customId = FixtureStringCustomGeneratorIdentity::new();
        $this->assertInstanceOf(FixtureStringCustomGeneratorIdentity::class, $customId);
    }

    public function testIdReturnTheProvidedId(): void
    {
        $this->assertSame('foobar', FixtureStringIdentity::from('foobar')->id());
    }

    public function testStringifyReturnTheProvidedIdAsString(): void
    {
        $this->assertSame('foobar', (string) FixtureStringIdentity::from('foobar'));
    }

    public function testEqualsWithSameIdShouldSuccess(): void
    {
        $id1 = FixtureStringIdentity::from('foobar');
        $id2 = FixtureStringIdentity::from('foobar');

        $this->assertSame($id1, $id2);
        $this->assertTrue($id1->equals($id1));
        $this->assertTrue($id1->equals($id2));

        $this->assertFalse($id1->equals(FixtureStringIdentity::from('foobarbaz')));
        $this->assertFalse($id1->equals(FixtureIntIdentity::from(123)));
    }

    /**
     * @param mixed $id
     * @return void
     * @dataProvider notStringData
     */
    public function testEqualsWithDifferentIdShouldFail(mixed $id): void
    {
        $this->expectException(\TypeError::class);
        $id1 = FixtureStringIdentity::from('foobar');

        $id1->equals($id);
    }

    /**
     * @return list<list<mixed>>
     */
    public function notStringData(): array
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
