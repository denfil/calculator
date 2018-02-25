<?php

declare(strict_types=1);

namespace Calculator\Evaluator;

use Calculator\Evaluator\Translator\TranslatorInterface;
use Calculator\Token\Operand\OperandInterface;
use Calculator\Token\Operator\OperatorInterface;

/**
 * Evaluator of tokens in Reverse Polish Notation.
 *
 * @see https://en.wikipedia.org/wiki/Reverse_Polish_notation
 * @package Calculator\Evaluator
 */
class ReversePolishNotation implements EvaluatorInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritdoc
     * @throws \InvalidArgumentException
     */
    public function evaluate(array $tokens)
    {
        $tokens = $this->translator->translate($tokens);
        $stack = [];
        foreach ($tokens as $token) {
            if ($token instanceof OperandInterface) {
                $stack[] = $token;
                continue;
            }
            if ($token instanceof OperatorInterface) {
                $isBinaryOperator = $token->getType() == OperatorInterface::TYPE_BINARY;
                $stackSize = count($stack);
                if ($stackSize < 1 || ($isBinaryOperator && $stackSize < 2)) {
                    throw new \InvalidArgumentException('Unable to evaluate expression');
                }
                $operand = array_pop($stack);
                $stack[] = $isBinaryOperator
                    ? $token->apply(array_pop($stack), $operand)
                    : $token->apply($operand);
                continue;
            }
            throw new \InvalidArgumentException('Unsupported token type');
        }
        if (count($stack) != 1) {
            throw new \InvalidArgumentException('Unable to evaluate expression');
        }
        return $stack[0]->getValue();
    }
}
