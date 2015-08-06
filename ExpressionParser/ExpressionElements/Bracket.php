<?php

namespace ExpressionParser\ExpressionElements;

class Bracket implements ExpressionElementInterface
{
    private $bracketType;

    public function __construct($bracketType)
    {
        $this->bracketType = $bracketType;
    }

    public function getBracketType()
    {
        return $this->bracketType;
    }

    public function getExpressionType()
    {
        return ExpressionElementInterface::BRACKET;
    }
}