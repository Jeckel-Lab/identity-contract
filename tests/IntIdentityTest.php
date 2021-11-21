<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 19/11/2021
 */

namespace Tests\JeckelLab\IdentityContract;

use JeckelLab\Contract\Application\Domain\Identity\Exception\EnableToGenerateNewIdentityException;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureIntIdentity;
use Tests\JeckelLab\IdentityContract\Fixtures\FixtureStringIdentity;
use PHPUnit\Framework\TestCase;
use stdClass;

class IntIdentityTest extends TestCase
{
    public function testConstructorWithIntShouldSuccess()
    {
        $this->assertInstanceOf(FixtureIntIdentity::class, new FixtureIntIdentity(25));
    }

    /**
     * @dataProvider notIntData
     * @param $invalidId
     */
    public function testConstructorWithNotIntShouldFail($invalidId)
    {
        try {
            new FixtureIntIdentity($invalidId);
        } catch (\Throwable $e) {
            $this->assertFalse(is_int($invalidId));
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testConstructorWithNullShouldFail()
    {
        try {
            new FixtureIntIdentity(null);
        } catch (\Throwable $e) {
            $this->assertTrue(true);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testFromWithIntShouldSuccess()
    {
        $this->assertInstanceOf(FixtureIntIdentity::class, FixtureIntIdentity::from(25));
    }

    /**
     * @dataProvider notIntData
     * @param $invalidId
     */
    public function testFromWithNotIntShouldFail($invalidId)
    {
        try {
            FixtureIntIdentity::from($invalidId);
        } catch (\Throwable $e) {
            $this->assertFalse(is_int($invalidId));
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testNewShouldFail()
    {
        try {
            FixtureIntIdentity::new();
        } catch (\Throwable $e) {
            $this->assertInstanceOf(EnableToGenerateNewIdentityException::class, $e);
            return;
        }
        $this->fail('Should have thrown exception or error');
    }

    public function testIdReturnTheProvidedId()
    {
        $this->assertSame(123, FixtureIntIdentity::new(123)->id());
    }

    public function testStringifyReturnTheProvidedIdAsString()
    {
        $this->assertSame('123', (string) FixtureIntIdentity::new(123));
    }

    public function testEqualsWithSameIdShouldSuccess()
    {
        $id1 = FixtureIntIdentity::new(123);
        $id2 = new FixtureIntIdentity(123);

        $this->assertTrue($id1->equalsTo($id1));
        $this->assertTrue($id1->equalsTo($id2));
    }

    public function testEqualsShouldDifferetIdShoudlFail()
    {
        $id1 = FixtureIntIdentity::new(123);
        // Test with same class
        $this->assertFalse($id1->equalsTo(FixtureIntIdentity::new(124)));

        // Test with something different
        $this->assertFalse($id1->equalsTo(123));
        $this->assertFalse($id1->equalsTo('123'));
        $this->assertFalse($id1->equalsTo(new stdClass()));
        $this->assertFalse($id1->equalsTo(new FixtureStringIdentity('Foobar')));
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
            [true],
            [false],
            [[123, 1254]],
            [new stdClass()]
        ];
    }

}
