<?php

namespace ExpressionParser\ExpressionElements;

class MinusOperator implements OperatorInterface, ExpressionElementInterface
{
    public function calculate($argument1, $argument2)
    {
        return $argument2 - $argument1;
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