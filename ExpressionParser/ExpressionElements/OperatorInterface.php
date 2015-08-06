<?php

namespace ExpressionParser\ExpressionElements;

interface OperatorInterface
{
    public function calculate($operand1, $operand2);
    public function getPrecedence();
    public function getAssociative();
}