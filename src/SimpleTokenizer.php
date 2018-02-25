<?php
declare(strict_types=1);

namespace Calculator;

use Calculator\Token\Operand\Number;
use Calculator\Token\Operator\Addition;
use Calculator\Token\Operator\Division;
use Calculator\Token\Operator\Multiplication;
use Calculator\Token\Operator\Negation;
use Calculator\Token\Operator\Subtraction;

/**
 * Simple math expression tokenizer.
 * Supported operations: + - / *
 *
 * @package Calculator
 */
class SimpleTokenizer implements TokenizerInterface
{
    private const CHAR_ADDITION = '+';
    private const CHAR_SUBTRACTION = '-';
    private const CHAR_MULTIPLICATION = '*';
    private const CHAR_DIVISION = '/';

    private $tokens = [];

    /**
     * @inheritdoc
     */
    public function tokenize(string $expression): array
    {
        $this->tokens = [];
        $number = '';
        for ($i = 0, $len = mb_strlen($expression); $i < $len; $i++) {
            $char = mb_substr($expression, $i, 1);
            // collect digits into number
            if (is_numeric($char)) {
                $number .= $char;
                continue;
            }
            if ($number) {
                $this->addToken($number);
                $number = '';
            }
            $this->addToken($char);
        }
        if ($number) {
            $this->addToken($number);
        }
        return $this->tokens;
    }

    /**
     * Add token to result.
     *
     * @param string $token
     * @throws \InvalidArgumentException
     */
    private function addToken(string $token)
    {
        switch ($token) {
            case static::CHAR_ADDITION:
                $result = new Addition($token);
                break;
            case static::CHAR_SUBTRACTION:
                $result = empty($this->tokens)
                    ? new Negation($token)
                    : new Subtraction($token);
                break;
            case static::CHAR_MULTIPLICATION:
                $result = new Multiplication($token);
                break;
            case static::CHAR_DIVISION:
                $result = new Division($token);
                break;
            default:
                if (is_numeric($token)) {
                    $result = new Number((int)$token);
                }
        }
        if (empty($result)) {
            throw new \InvalidArgumentException("Unsupported token \"$token\"");
        }
        $this->tokens[] = $result;
    }
}
