<?php

namespace ExpressionParser\Tokens;

class Token implements TokenInterface
{

    /** @var int the token identifier */
    private $tokenId;
    /** @var string the string content token */
    private $value;

    public function __construct($token, $content)
    {
        $this->tokenId = $token;
        $this->value = $content;
    }

    public function __toString()
    {
        return "Type: " . $this->tokenId . ", value: " . $this->value;
    }

    public function getTokenId()
    {
        return $this->tokenId;
    }

    public function getValue()
    {
        return $this->value;
    }
}
