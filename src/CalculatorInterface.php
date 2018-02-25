<?php

declare(strict_types=1);

namespace Calculator;

interface CalculatorInterface
{
    /**
     * Parse string of math expression and calculate result.
     *
     * @param string $expression
     * @return mixed
     */
    public function calculate(string $expression);
}
