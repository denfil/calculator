<?php

declare(strict_types=1);

namespace Calculator;

use Calculator\Evaluator\EvaluatorInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\SimpleCalculator
 */
class SimpleCalculatorTest extends TestCase
{
    /**
     * @covers ::calculate
     */
    public function testCalculate()
    {
        $expression = '2+3';
        $tokens = [1, 2, 3];
        $tokenizer = $this->createMock(TokenizerInterface::class);
        $tokenizer->expects($this->once())
            ->method('tokenize')
            ->with($this->equalTo($expression))
            ->willReturn($tokens);
        $evaluator = $this->createMock(EvaluatorInterface::class);
        $evaluator->expects($this->once())
            ->method('evaluate')
            ->with($this->equalTo($tokens))
            ->willReturn(7);
        $calculator = new SimpleCalculator($tokenizer, $evaluator);
        $actual = $calculator->calculate($expression);
        $expected = 7;
        $this->assertEquals($expected, $actual);
    }
}
