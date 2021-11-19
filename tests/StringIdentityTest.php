<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

namespace Tests\JeckelLab\IdentityContract;

use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringIdentity;
use PHPUnit\Framework\TestCase;
use stdClass;

class StringIdentityTest extends TestCase
{
    public function testConstructorWithStringShouldSuccess()
    {
        $this->assertInstanceOf(FixtureStringIdentity::class, new FixtureStringIdentity('foobar'));
    }

    /**
     * @dataProvider notStringData
     * @param $invalidId
     */
    public function testConstructorWithNotStringShouldFail($invalidId)
    {
        try {
            new FixtureStringIdentity($invalidId);
        } catch (\Throwable $e) {
            $this->assertFalse(is_string($invalidId));
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testConstructorWithNullShouldFail()
    {
        try {
            new FixtureStringIdentity(null);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewWithStringShouldSuccess()
    {
        $this->assertInstanceOf(FixtureStringIdentity::class, FixtureStringIdentity::new('barfoo'));
    }

    /**
     * @dataProvider notStringData
     * @param $invalidId
     */
    public function testNewWithNotStringShouldFail($invalidId)
    {
        try {
            FixtureStringIdentity::new($invalidId);
        } catch (\Throwable $e) {
            $this->assertFalse(is_string($invalidId));
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewWithoutArgumentsShouldGenerateRandomId()
    {
        $id1 = FixtureStringIdentity::new();
        $this->assertInstanceOf(FixtureStringIdentity::class, $id1);

        $id2 = FixtureStringIdentity::new();
        $this->assertInstanceOf(FixtureStringIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());
    }

    public function testNewWithNullShouldGenerateRandomId()
    {
        $id1 = FixtureStringIdentity::new(null);
        $this->assertInstanceOf(FixtureStringIdentity::class, $id1);

        $id2 = FixtureStringIdentity::new(null);
        $this->assertInstanceOf(FixtureStringIdentity::class, $id2);

        $this->assertNotEquals($id1->id(), $id2->id());
    }

    public function testIdReturnTheProvidedId()
    {
        $this->assertSame('foobar', FixtureStringIdentity::new('foobar')->id());
    }

    public function testStringifyReturnTheProvidedIdAsString()
    {
        $this->assertSame('foobar', (string) FixtureStringIdentity::new('foobar'));
    }

    public function testEqualsWithSameIdShouldSuccess()
    {
        $id1 = FixtureStringIdentity::new('foobar');
        $id2 = new FixtureStringIdentity('foobar');

        $this->assertTrue($id1->equalsTo($id1));
        $this->assertTrue($id1->equalsTo($id2));
    }

    public function testEqualsShouldDifferetIdShoudlFail()
    {
        $id1 = FixtureStringIdentity::new('foobar');
        // Test with same class
        $this->assertFalse($id1->equalsTo(FixtureStringIdentity::new('foobarbaz')));

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
            [123],
            [true],
            [false],
            [[123, 1254]],
            [new stdClass()]
        ];
    }
}
