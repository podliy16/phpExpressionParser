<?php

namespace ExpressionParser;

use ExpressionParser\Tokens\Tokenizer;

class ExpressionParserFactory
{
    public static function create()
    {
        $tokenizer = new Tokenizer();
        $shuntingYard = new ShuntingYard();
        $expressionParser = new ExpressionParser($tokenizer, $shuntingYard);

        return $expressionParser;
    }
}