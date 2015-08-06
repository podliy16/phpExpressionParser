<?php

namespace ExpressionParser\ExpressionElements;

class ExponentOperator implements OperatorInterface, ExpressionElementInterface
{
    public function calculate($argument1, $argument2)
    {
        return pow($argument2, $argument1);
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::OPERATOR;
    }

    public function getPrecedence()
    {
        return 2;
    }

    public function getAssociative()
    {
        return 'right';
    }
}