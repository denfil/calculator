<?php

declare(strict_types=1);

namespace Calculator\Evaluator;

use Calculator\Evaluator\Translator\TranslatorInterface;
use Calculator\Token\Operand\Number;
use Calculator\Token\Operator\Addition;
use Calculator\Token\Operator\Division;
use Calculator\Token\Operator\Negation;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Evaluator\ReversePolishNotation
 */
class ReversePolishNotationTest extends TestCase
{
    /**
     * @covers ::evaluate
     */
    public function testEvaluateValidExpression()
    {
        $tokens = [
            new Negation('-'),
            new Number(3),
            new Addition('+'),
            new Number(10),
            new Division('/'),
            new Number(2)
        ];
        $rpn = [
            new Number(3),
            new Negation('-'),
            new Number(10),
            new Number(2),
            new Division('/'),
            new Addition('+')
        ];
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->expects($this->once())
            ->method('translate')
            ->with($this->equalTo($tokens))
            ->willReturn($rpn);
        $evaluator = new ReversePolishNotation($translator);
        $actual = $evaluator->evaluate($tokens);
        $expected = 2;
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::evaluate
     */
    public function testEvaluateExpressionWithUnsupportedToken()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported token type');
        $rpn = [
            new Number(3),
            '%',
            new Number(10),
        ];
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->method('translate')
            ->willReturn($rpn);
        $evaluator = new ReversePolishNotation($translator);
        $evaluator->evaluate([]);
    }

    /**
     * @covers ::evaluate
     */
    public function testEvaluateInvalidExpression()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unable to evaluate expression');
        $rpn = [
            new Number(3),
            new Addition('+'),
        ];
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->method('translate')
            ->willReturn($rpn);
        $evaluator = new ReversePolishNotation($translator);
        $evaluator->evaluate([]);
    }
}
