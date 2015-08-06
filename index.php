<?php

error_reporting(E_ALL);

function __autoload($class) {
    $class = str_replace('\\', '/', $class) . '.php';
    require_once($class);
}

$expression = "(2*(x+(y-2)))";

$expressionParser = \ExpressionParser\ExpressionParserFactory::create();
$expressionParser->parse($expression);
$result = $expressionParser->calculate([
        "x" => 4,
        "y" => 3
    ]);
var_dump($result);
$result = $expressionParser->calculate([
        "x" => 10,
        "y" => 5
    ]);
var_dump($result);