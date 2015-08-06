<?php

namespace ExpressionParser\ExpressionElements;

class MultiplicationOperator implements OperatorInterface, ExpressionElementInterface
{
    public function calculate($argument1, $argument2)
    {
        return $argument1 * $argument2;
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::OPERATOR;
    }

    public function getPrecedence()
    {
        return 1;
    }

    public function getAssociative()
    {
        return 'left';
    }
}