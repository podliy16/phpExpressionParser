<?php

namespace ExpressionParser\ExpressionElements;

class DivisionOperator implements OperatorInterface, ExpressionElementInterface
{
    public function calculate($argument1, $argument2)
    {
        return $argument2 / $argument1;
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