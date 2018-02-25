<?php

declare(strict_types=1);

namespace Calculator\Token;

interface TokenInterface
{
    /**
     * @return mixed
     */
    public function getValue();
}
