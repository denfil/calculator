<?php

declare(strict_types=1);

namespace Calculator\Evaluator\Translator;

use Calculator\Token\Operand\OperandInterface;
use Calculator\Token\Operator\OperatorInterface;

/**
 * Translator of tokens into Reverse Polish Notation.
 *
 * @see https://en.wikipedia.org/wiki/Reverse_Polish_notation
 * @package Calculator\Evaluator\Translator
 */
class ReversePolishNotation implements TranslatorInterface
{
    /**
     * @inheritdoc
     * @throws \InvalidArgumentException
     */
    public function translate(array $tokens): array
    {
        $result = [];
        $operators = [];
        foreach ($tokens as $token) {
            if ($token instanceof OperandInterface) {
                $result[] = $token;
                continue;
            }
            if ($token instanceof OperatorInterface) {
                $o1 = $token;
                while (true) {
                    $o2 = end($operators);
                    if (!($o2 instanceof OperatorInterface)) {
                        break;
                    }
                    $validLeftAssoc = $o1->getAssociation() === OperatorInterface::ASSOC_LEFT
                        && $o1->getPriority() <= $o2->getPriority();
                    $validRightAssoc = $o1->getAssociation() === OperatorInterface::ASSOC_RIGHT
                        && $o1->getPriority() < $o2->getPriority();
                    if ($validLeftAssoc || $validRightAssoc) {
                        $result[] = array_pop($operators);
                    } else {
                        break;
                    }
                }
                $operators[] = $o1;
                continue;
            }
            throw new \InvalidArgumentException('Unsupported token type');
        }
        $result = array_merge($result, array_reverse($operators));
        return $result;
    }
}
