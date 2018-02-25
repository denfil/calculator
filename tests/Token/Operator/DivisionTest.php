<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\Number;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Token\Operator\Division
 */
class DivisionTest extends TestCase
{
    /**
     * @covers ::apply
     * @dataProvider divisionProvider
     */
    public function testApply($a, $b, $expected)
    {
        $actual = (new Division('/'))->apply($a, $b);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::apply
     */
    public function testSecondOperandIsNull()
    {
        $this->expectException(\DivisionByZeroError::class);
        (new Division('/'))->apply(new Number(9), null);
    }

    /**
     * @covers ::apply
     */
    public function testSecondOperandIsZero()
    {
        $this->expectException(\DivisionByZeroError::class);
        (new Division('/'))->apply(new Number(9), new Number(0));
    }

    public function divisionProvider()
    {
        return [
            [new Number(8), new Number(4), new Number(2)],
            [new Number(-8), new Number(2), new Number(-4)],
            [new Number(9), new Number(-3), new Number(-3)],
            [new Number(-10), new Number(-2), new Number(5)],
            [new Number(0), new Number(2), new Number(0)]
        ];
    }
}
