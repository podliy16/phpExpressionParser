<?php

namespace ExpressionParser\ExpressionElements;

use ExpressionParser\ExpressionElements;

class Variable implements ValueInterface, ExpressionElementInterface
{
    protected $value;

    public function __construct($variableName)
    {
        $this->value = $variableName;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::VARIABLE;
    }

}