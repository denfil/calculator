<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\AbstractToken;
use Calculator\Token\Operand\Number;
use Calculator\Token\Operand\OperandInterface;

class Negation extends AbstractToken implements OperatorInterface
{
    /**
     * @inheritdoc
     */
    public function getType(): int
    {
        return static::TYPE_UNARY;
    }

    /**
     * @inheritdoc
     */
    public function getPriority(): int
    {
        return 3;
    }

    /**
     * @inheritdoc
     */
    public function getAssociation(): int
    {
        return static::ASSOC_RIGHT;
    }

    /**
     * @inheritdoc
     */
    public function apply(OperandInterface $a, OperandInterface $b = null): OperandInterface
    {
        return new Number(-$a->getValue());
    }
}
