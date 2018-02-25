<?php

declare(strict_types=1);

namespace Calculator;

interface TokenizerInterface
{
    /**
     * Tokenize expression.
     *
     * @param string $expression
     * @return array
     */
    public function tokenize(string $expression): array;
}
