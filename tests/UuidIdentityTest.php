<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

declare(strict_types=1);

namespace Tests\JeckelLab\IdentityContract;

use PHPUnit\Framework\TestCase;
use stdClass;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureUuidIdentity;

class UuidIdentityTest extends TestCase
{
    public function testConstructorWithValidUuidShouldSuccess()
    {
        $this->assertInstanceOf(
            FixtureUuidIdentity::class,
            new FixtureUuidIdentity("6868615b-b8ca-475e-84c7-81695357fba3")
        );
    }

    /**
     * @dataProvider notStringData
     * @param $invalidId
     */
    public function testConstructorWithNotUuidShouldFail($invalidId)
    {
        try {
            new FixtureUuidIdentity($invalidId);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testConstructorWithNullShouldFail()
    {
        try {
            new FixtureUuidIdentity(null);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewWithValidUuidShouldSuccess()
    {
        $this->assertInstanceOf(
            FixtureUuidIdentity::class,
            FixtureUuidIdentity::new("f1a6e508-3bb4-4051-b854-746ac239d0e2")
        );
    }

    /**
     * @dataProvider notStringData
     * @param $invalidId
     */
    public function testNewWithNotUuidShouldFail($invalidId)
    {
        try {
            FixtureUuidIdentity::new($invalidId);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewWithoutArgumentsShouldGenerateRandomId()
    {
        $id1 = FixtureUuidIdentity::new();
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id1);

        $id2 = FixtureUuidIdentity::new();
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());
    }

    public function testNewWithNullShouldGenerateRandomId()
    {
        $id1 = FixtureUuidIdentity::new(null);
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id1);

        $id2 = FixtureUuidIdentity::new(null);
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());
    }

    public function testIdReturnTheProvidedId()
    {
        $this->assertSame(
            "a50ce464-350f-4409-a56a-9292ab833f48",
            FixtureUuidIdentity::new("a50ce464-350f-4409-a56a-9292ab833f48")->id()
        );
    }

    public function testStringifyReturnTheProvidedIdAsString()
    {
        $this->assertSame(
            "2822f727-317b-4af5-b1f9-24384094cc2f",
            (string) FixtureUuidIdentity::new("2822f727-317b-4af5-b1f9-24384094cc2f")
        );
    }

    public function testEqualsWithSameIdShouldSuccess()
    {
        $id1 = FixtureUuidIdentity::new("7ade903d-9a67-41ad-bb9b-93c8d61ce531");
        $id2 = new FixtureUuidIdentity("7ade903d-9a67-41ad-bb9b-93c8d61ce531");

        $this->assertTrue($id1->equalsTo($id1));
        $this->assertTrue($id1->equalsTo($id2));
    }

    public function testEqualsShouldDifferetIdShoudlFail()
    {
        $id1 = FixtureUuidIdentity::new("4fb97fe3-09db-4814-a7a1-1cd05a1702dc");
        // Test with same class
        $this->assertFalse($id1->equalsTo(FixtureUuidIdentity::new("82381629-db1a-4e6f-8edb-957ff80a31c8")));

        // Test with string id and same value
        $this->assertFalse($id1->equalsTo(FixtureStringIdentity::new("4fb97fe3-09db-4814-a7a1-1cd05a1702dc")));

        // Test with something different
        $this->assertFalse($id1->equalsTo(123));
        $this->assertFalse($id1->equalsTo('123'));
        $this->assertFalse($id1->equalsTo(new stdClass()));
        $this->assertFalse($id1->equalsTo(new FixtureIntIdentity(123)));
    }

    /**
     * @return list<list<mixed>>
     */
    public function notStringData(): array
    {
        return [
            ['foobar'],
            [123],
            [true],
            [false],
            [[123, 1254]],
            [new stdClass()]
        ];
    }
}
