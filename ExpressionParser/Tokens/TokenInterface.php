<?php

namespace ExpressionParser\Tokens;

interface TokenInterface
{
    const PLUS = 0;
    const MINUS = 1;
    const MULT = 2;
    const DIV = 3;
    const RAISED = 4;
    const OPEN_BRACKET = 5;
    const CLOSE_BRACKET = 6;
    const NUMBER = 7;
    const VARIABLE = 8;

    public function getValue();
    public function getTokenId();
}