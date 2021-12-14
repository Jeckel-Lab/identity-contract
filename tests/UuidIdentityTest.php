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

/**
 * Class UuidIdentityTest
 * @package Tests\JeckelLab\IdentityContract
 * @psalm-suppress PropertyNotSetInConstructor
 */
class UuidIdentityTest extends TestCase
{
    public function testFromWithValidUuidShouldSuccess(): void
    {
        $this->assertInstanceOf(
            FixtureUuidIdentity::class,
            FixtureUuidIdentity::from("f1a6e508-3bb4-4051-b854-746ac239d0e2")
        );
        $this->assertInstanceOf(
            FixtureUuidIdentity::class,
            FixtureUuidIdentity::from("f1a6e508-3bb4-4051-b854-746ac239d0e2")
        );
    }

    /**
     * @dataProvider notValidUuidData
     * @param $invalidId
     */
    public function testFromWithNotUuidShouldFail($invalidId): void
    {
        try {
            FixtureUuidIdentity::from($invalidId);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewWithoutArgumentsShouldGenerateRandomId(): void
    {
        $id1 = FixtureUuidIdentity::new();
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id1);

        $id2 = FixtureUuidIdentity::new();
        $this->assertInstanceOf(FixtureUuidIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());
    }

    public function testIdReturnTheProvidedId(): void
    {
        $this->assertSame(
            "a50ce464-350f-4409-a56a-9292ab833f48",
            FixtureUuidIdentity::from("a50ce464-350f-4409-a56a-9292ab833f48")->id()
        );
    }

    public function testStringifyReturnTheProvidedIdAsString(): void
    {
        $this->assertSame(
            "2822f727-317b-4af5-b1f9-24384094cc2f",
            (string) FixtureUuidIdentity::from("2822f727-317b-4af5-b1f9-24384094cc2f")
        );
    }

    public function testEqualsWithSameIdShouldSuccess(): void
    {
        $id1 = FixtureUuidIdentity::from("7ade903d-9a67-41ad-bb9b-93c8d61ce531");
        $id2 = FixtureUuidIdentity::from("7ade903d-9a67-41ad-bb9b-93c8d61ce531");

        $this->assertSame($id1, $id2);
        $this->assertTrue($id1->equals($id1));
        $this->assertTrue($id1->equals($id2));

        $this->assertFalse($id1->equals(FixtureUuidIdentity::from("82381629-db1a-4e6f-8edb-957ff80a31c8")));
        $this->assertFalse($id1->equals(FixtureIntIdentity::from(123)));
        $this->assertFalse($id1->equals(FixtureStringIdentity::from('7ade903d-9a67-41ad-bb9b-93c8d61ce531')));
    }

    /**
     * @param mixed $id
     * @return void
     * @dataProvider notValidUuidData
     */
    public function testEqualsWithDifferentIdShouldFail(mixed $id): void
    {
        $id1 = FixtureUuidIdentity::from("4fb97fe3-09db-4814-a7a1-1cd05a1702dc");
        $this->assertFalse($id1->equals($id));
    }

    /**
     * @return void
     * @throws \JsonException
     */
    public function testJsonSerialization(): void
    {
        $this->assertEquals(
            '"4fb97fe3-09db-4814-a7a1-1cd05a1702dc"',
            json_encode(FixtureUuidIdentity::from("4fb97fe3-09db-4814-a7a1-1cd05a1702dc"), JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @return list<list<mixed>>
     */
    public function notValidUuidData(): array
    {
        return [
            [null],
            ['foobar'],
            [123],
            [true],
            [false],
            [[123, 1254]],
            [new stdClass()],
            // close but invalid uuid
            ["4fb97fe3-09db-4814-a7a1-1cd05a1702dc-vhkvl"],
            ["cgkck-4fb97fe3-09db-4814-a7a1-1cd05a1702dc"],
            ["4fB97fE3-09db-4814-a7a1-1cd05a1702dc"],
            ["82381629-db1a-4e6f-8edb-957ff80a31c8\n"],
        ];
    }
}
