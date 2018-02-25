<?php

declare(strict_types=1);

namespace Calculator\Evaluator\Translator;

use Calculator\Token\Operand\Number;
use Calculator\Token\Operator\Addition;
use Calculator\Token\Operator\Division;
use Calculator\Token\Operator\Negation;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\Evaluator\Translator\ReversePolishNotation
 */
class ReversePolishNotationTest extends TestCase
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->translator = new ReversePolishNotation();
    }

    /**
     * @covers ::translate
     */
    public function testTranslateSupportedTokens()
    {
        $tokens = [
            new Negation('-'),
            new Number(3),
            new Addition('+'),
            new Number(10),
            new Division('/'),
            new Number(2)
        ];
        $actual = $this->translator->translate($tokens);
        $expected = [
            new Number(3),
            new Negation('-'),
            new Number(10),
            new Number(2),
            new Division('/'),
            new Addition('+')
        ];
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::translate
     */
    public function testTranslateUnsupportedTokens()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported token type');
        $tokens = [
            new Number(2),
            '%',
            new Number(10),
        ];
        $this->translator->translate($tokens);
    }
}
