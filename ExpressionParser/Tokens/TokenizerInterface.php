<?php

namespace ExpressionParser\Tokens;

interface TokenizerInterface
{
    public function tokenize($expression);
}