<?php

namespace ExpressionParser;

use ExpressionParser\Tokens\Token;
use ExpressionParser\Tokens\TokenInterface;
use ExpressionParser\Tokens\TokenizerInterface;
use ExpressionParser\ExpressionElements\ExpressionElementInterface;
use ExpressionParser\ExpressionElements\Constant;
use ExpressionParser\ExpressionElements\OperatorInterface;
use ExpressionParser\ExpressionElements\Variable;

class ExpressionParser
{
    private $tokenizer;
    private $shuntingYard;

    /** @var ExpressionElementInterface[] */
    private $reversePolandNotation;

    /** @var Token[] */
    private $tokens;

    /** @const */
    public static $operators = [
        TokenInterface::PLUS,
        TokenInterface::MINUS,
        TokenInterface::MULT,
        TokenInterface::DIV,
        TokenInterface::RAISED
    ];

    public function __construct(TokenizerInterface $tokenizer, ShuntingYard $shuntingYard)
    {
        $this->tokenizer = $tokenizer;
        $this->shuntingYard = $shuntingYard;
    }

    public function parse($expression)
    {
        $this->tokens = $this->tokenizer->tokenize($expression);
        $this->reversePolandNotation = $this->shuntingYard->shuntingYard($this->tokens);
    }

    public function calculate(array $variables)
    {
        $stack = new \SplStack();
        foreach ($this->reversePolandNotation as $token) {
            if ($token->getExpressionType() == ExpressionElementInterface::CONSTANT) {
                /** @var $token Constant */
                $stack->push($token->getValue());
            }
            if ($token->getExpressionType() == ExpressionElementInterface::VARIABLE) {
                /** @var $token Variable*/
                $variableName = $token->getValue();
                if (isset($variables[$variableName])) {
                    $stack->push($variables[$variableName]);
                } else {
                    throw new ExpressionParserException("Undefined variable: " . $variableName);
                }
            }
            if ($token->getExpressionType() == ExpressionElementInterface::OPERATOR) {
                /** @var $token OperatorInterface */
                $arg1 = $stack->pop();
                $arg2 = $stack->pop();
                $stack->push($token->calculate($arg1, $arg2));
            }
        }
        return $stack->top();
    }
}



