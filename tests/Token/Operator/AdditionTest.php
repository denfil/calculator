<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\Number;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Token\Operator\Addition
 */
class AdditionTest extends TestCase
{
    /**
     * @covers ::apply
     * @dataProvider additionProvider
     */
    public function testApply($a, $b, $expected)
    {
        $actual = (new Addition('+'))->apply($a, $b);
        $this->assertEquals($expected, $actual);
    }

    public function additionProvider()
    {
        return [
            [new Number(2), new Number(3), new Number(5)],
            [new Number(-3), new Number(5), new Number(2)],
            [new Number(-1), new Number(-2), new Number(-3)],
            [new Number(2), null, new Number(2)]
        ];
    }
}
