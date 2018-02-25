<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\AbstractToken;
use Calculator\Token\Operand\Number;
use Calculator\Token\Operand\OperandInterface;

class Addition extends AbstractToken implements OperatorInterface
{
    /**
     * @inheritdoc
     */
    public function getType(): int
    {
        return static::TYPE_BINARY;
    }

    /**
     * @inheritdoc
     */
    public function getPriority(): int
    {
        return 1;
    }

    /**
     * @inheritdoc
     */
    public function getAssociation(): int
    {
        return static::ASSOC_LEFT;
    }

    /**
     * @inheritdoc
     */
    public function apply(OperandInterface $a, OperandInterface $b = null): OperandInterface
    {
        $b = $b !== null ? $b->getValue() : 0;
        return new Number($a->getValue() + $b);
    }
}
