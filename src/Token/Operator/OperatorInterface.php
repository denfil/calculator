<?php

declare(strict_types=1);

namespace Calculator\Token\Operator;

use Calculator\Token\Operand\OperandInterface;
use Calculator\Token\TokenInterface;

interface OperatorInterface extends TokenInterface
{
    /**
     * Binary operation
     */
    const TYPE_BINARY = 1;

    /**
     * Unary operation
     */
    const TYPE_UNARY = 2;

    /**
     * Left association
     */
    const ASSOC_LEFT = 3;

    /**
     * Right association
     */
    const ASSOC_RIGHT = 4;

    /**
     * @return int TYPE_BINARY | TYPE_UNARY
     */
    public function getType(): int;

    /**
     * @return int
     */
    public function getPriority(): int;

    /**
     * @return int ASSOC_LEFT | ASSOC_RIGHT
     */
    public function getAssociation(): int;

    /**
     * @param OperandInterface $a
     * @param OperandInterface|null $b
     * @return OperandInterface
     */
    public function apply(OperandInterface $a, OperandInterface $b = null): OperandInterface;
}
