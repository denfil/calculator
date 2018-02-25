<?php

declare(strict_types=1);

namespace Calculator\Evaluator;

interface EvaluatorInterface
{
    /**
     * Evaluate token array.
     *
     * @param array $tokens
     * @return mixed
     */
    public function evaluate(array $tokens);
}
