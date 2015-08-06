<?php

namespace ExpressionParser\ExpressionElements;

use ExpressionParser\Tokens\TokenInterface;

class OperatorsFactory
{
    public static function create($operatorType)
    {
        switch ($operatorType) {
        case TokenInterface::PLUS:
            return new PlusOperator();
        case TokenInterface::MINUS:
            return new MinusOperator();
        case TokenInterface::MULT:
            return new MultiplicationOperator();
        case TokenInterface::DIV:
            return new DivisionOperator();
        case TokenInterface::RAISED:
            return new ExponentOperator();
        default:
            throw new InvalidOperatorException("Invalid operator exception with id: "
                                               .$operatorType);
        }
    }
}