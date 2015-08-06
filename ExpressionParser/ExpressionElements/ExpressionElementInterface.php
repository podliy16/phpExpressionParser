<?php

namespace ExpressionParser\ExpressionElements;

interface ExpressionElementInterface
{
    const CONSTANT = 0;
    const VARIABLE = 1;
    const OPERATOR = 2;
    const BRACKET = 3;

    public function getExpressionType();
}