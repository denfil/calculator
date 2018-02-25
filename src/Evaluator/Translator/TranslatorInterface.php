<?php

declare(strict_types=1);

namespace Calculator\Evaluator\Translator;

interface TranslatorInterface
{
    /**
     * Translate token array into evaluator's supported format.
     *
     * @param array $tokens
     * @return array
     */
    public function translate(array $tokens): array;
}
