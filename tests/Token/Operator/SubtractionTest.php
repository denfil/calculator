<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\Number;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Token\Operator\Subtraction
 */
class SubtractionTest extends TestCase
{
    /**
     * @covers ::apply
     * @dataProvider subtractionProvider
     */
    public function testApply($a, $b, $expected)
    {
        $actual = (new Subtraction('-'))->apply($a, $b);
        $this->assertEquals($expected, $actual);
    }

    public function subtractionProvider()
    {
        return [
            [new Number(3), new Number(2), new Number(1)],
            [new Number(-4), new Number(3), new Number(-7)],
            [new Number(5), new Number(-3), new Number(8)],
            [new Number(-1), new Number(-4), new Number(3)],
            [new Number(2), null, new Number(2)]
        ];
    }
}
