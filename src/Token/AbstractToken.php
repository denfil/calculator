<?php

declare(strict_types=1);

namespace Calculator\Token;

abstract class AbstractToken implements TokenInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }
}
