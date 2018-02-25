<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\Number;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Token\Operator\Negation
 */
class NegationTest extends TestCase
{
    /**
     * @covers ::apply
     * @dataProvider negationProvider
     */
    public function testApply($a, $b, $expected)
    {
        $actual = (new Negation('-'))->apply($a, $b);
        $this->assertEquals($expected, $actual);
    }

    public function negationProvider()
    {
        return [
            [new Number(2), new Number(3), new Number(-2)],
            [new Number(-3), new Number(5), new Number(3)],
            [new Number(7), null, new Number(-7)]
        ];
    }
}
