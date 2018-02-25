<?php

declare(strict_types=1);

namespace Calculator;

use Calculator\Evaluator\EvaluatorInterface;

/**
 * Simple calculator.
 *
 * @package Calculator
 */
class SimpleCalculator implements CalculatorInterface
{
    /**
     * @var TokenizerInterface
     */
    private $tokenizer;

    /**
     * @var EvaluatorInterface
     */
    private $evaluator;

    public function __construct(TokenizerInterface $tokenizer, EvaluatorInterface $evaluator)
    {
        $this->tokenizer = $tokenizer;
        $this->evaluator = $evaluator;
    }

    /**
     * @inheritdoc
     */
    public function calculate(string $expression)
    {
        $tokens = $this->tokenizer->tokenize($expression);
        $result = $this->evaluator->evaluate($tokens);
        return $result;
    }
}
