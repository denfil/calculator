<?php

declare(strict_types=1);

namespace Calculator;

use Calculator\Token\Operand\Number;
use Calculator\Token\Operator\Addition;
use Calculator\Token\Operator\Division;
use Calculator\Token\Operator\Multiplication;
use Calculator\Token\Operator\Negation;
use Calculator\Token\Operator\Subtraction;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Calculator\SimpleTokenizer
 */
class SimpleTokenizerTest extends TestCase
{
    /**
     * @var TokenizerInterface
     */
    private $tokenizer;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->tokenizer = new SimpleTokenizer();
    }

    /**
     * @covers ::tokenize
     */
    public function testNumbersParsing()
    {
        $actual = $this->tokenizer->tokenize('123+45*6');
        $expected = [
            new Number(123),
            new Addition('+'),
            new Number(45),
            new Multiplication('*'),
            new Number(6)
        ];
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::tokenize
     */
    public function testOperatorsParsing()
    {
        $actual = $this->tokenizer->tokenize('-1*2-3+4/5');
        $expected = [
            new Negation('-'),
            new Number(1),
            new Multiplication('*'),
            new Number(2),
            new Subtraction('-'),
            new Number(3),
            new Addition('+'),
            new Number(4),
            new Division('/'),
            new Number(5)
        ];
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers ::tokenize
     */
    public function testUnsupportedTokenParsing()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Unsupported token \"%\"");
        $this->tokenizer->tokenize('12%3');
    }
}
