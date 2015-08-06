<?php

namespace ExpressionParser\ExpressionElements;

class PlusOperator implements OperatorInterface, ExpressionElementInterface
{
    public function calculate($argument1, $argument2)
    {
        return $argument1 + $argument2;
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::OPERATOR;
    }

    public function getPrecedence()
    {
        return 0;
    }

    public function getAssociative()
    {
        return 'left';
    }
}