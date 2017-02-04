<?php declare(strict_types = 1);
/**
 * @category     UnitTests
 * @package      PassGen
 * @copyright    Copyright (c) 2017 Bentler Design (www.bricebentler.com)
 * @author       Brice Bentler <me@bricebentler.com>
 */

namespace Test\Unit;

use BentlerDesign\Helpers\StringsHelper;
use PHPUnit_Framework_TestCase;

class StringsHelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \TypeError
     */
    public function testRandomPasswordOnlyAcceptsIntegers()
    {
        StringsHelper::randomPassword('not an integer');
    }

    /**
     * Data provider for testRandomPasswordReturnsCorrectLengthString().
     *
     * @return array
     */
    public function providerRandomPasswordReturnsCorrectLengthString()
    {
        return [
            [1],
            [8],
            [22],
            [100],
            [999],
            [23481],
            [11],
            [56],
        ];
    }

    /**
     * @param int $length
     *
     * @dataProvider providerRandomPasswordReturnsCorrectLengthString
     */
    public function testRandomPasswordReturnsCorrectLengthString(int $length)
    {
        $password = StringsHelper::randomPassword($length);

        $this->assertInternalType('string', $password);
        $this->assertSame($length, strlen($password));
    }

    /**
     * Data provider for testRandomPasswordThrowsExceptionWhenLengthTooLow().
     *
     * @return array
     */
    public function providerRandomPasswordThrowsExceptionWhenLengthTooLow()
    {
        return [
            [0],
            [-1],
            [-100],
            [-99999],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     *
     * @dataProvider providerRandomPasswordThrowsExceptionWhenLengthTooLow
     */
    public function testRandomPasswordThrowsExceptionWhenLengthTooLow($length)
    {
        StringsHelper::randomPassword($length);
    }
}
