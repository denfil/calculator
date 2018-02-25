<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\Number;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Token\Operator\Multiplication
 */
class MultiplicationTest extends TestCase
{
    /**
     * @covers ::apply
     * @dataProvider multiplicationProvider
     */
    public function testApply($a, $b, $expected)
    {
        $actual = (new Multiplication('*'))->apply($a, $b);
        $this->assertEquals($expected, $actual);
    }

    public function multiplicationProvider()
    {
        return [
            [new Number(2), new Number(3), new Number(6)],
            [new Number(-2), new Number(5), new Number(-10)],
            [new Number(3), new Number(-5), new Number(-15)],
            [new Number(-2), new Number(-7), new Number(14)],
            [new Number(2), null, new Number(0)]
        ];
    }
}
