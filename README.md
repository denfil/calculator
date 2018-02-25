# Calculator

Parse string of math expression and calculate result. 

## Usage

``` php
use Calculator\SimpleCalculator;
use Calculator\SimpleTokenizer;
use Calculator\Evaluator\ReversePolishNotation as RPNEvaluator;
use Calculator\Evaluator\Translator\ReversePolishNotation as RPNTranslator;

$calculator = new SimpleCalculator(
    new SimpleTokenizer(),
    new RPNEvaluator(new RPNTranslator())
);

try {
    echo $calculator->calculate('-1+34/2-4*3');
} catch (Exception $e) {
    echo $e->getMessage();
}
```

## Customization

`Calculator\CalculatorInterface` is an interface of calculator. 
Implement it if you need your own calculator with blackjack and ballerinas, e.g. based on WolframAlpha APIs.

Calculator consists of two parts - tokenizer and evaluator.

Tokenizer implements interface `Calculator\TokenizerInterface`.
It parses input string of math expression and produces an array of tokens - operators and operands.
`Calculator\Token\AbstractToken` is an abstract class to represent token.
`Calculator\Token\Operand\OperandInterface` is an interface of operand token.
`Calculator\Token\Operator\OperatorInterface` is an interface of operator token.

Evaluator implements interface `Calculator\EvaluatorInterface`.
It gets array of tokens and calculates result of math expression.
In some cases it could be need to reorder array of tokens. For this evaluator uses translator which implements interface `Calculator\Evaluator\Translator\TranslatorInterface`.

You can replace all calculator components, even calculator it self, by implementing
interfaces described above. 

## Testing

Build Docker image
``` bash
$ make install
```

Run unit tests
``` bash
$ make test
```
