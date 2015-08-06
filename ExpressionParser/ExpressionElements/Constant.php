<?php

namespace ExpressionParser\ExpressionElements;

class Constant implements ValueInterface, ExpressionElementInterface
{
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::CONSTANT;
    }
}