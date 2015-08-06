<?php

namespace ExpressionParser\Tokens;

/**
 * Class Tokenizer
 *
 * Parse an input string to tokens.
 * @package ExpressionParser
 */
class Tokenizer implements TokenizerInterface
{
    /** @var array all possible tokens */
    private static $possibleTokens = [
        [
            "regexp"  => "\\+",
            "tokenId" => Token::PLUS
        ],
        [
            "regexp"  => "-",
            "tokenId" => Token::MINUS
        ],
        [
            "regexp"  => "\\*",
            "tokenId" => Token::MULT
        ],
        [
            "regexp"  => "\\/",
            "tokenId" => Token::DIV
        ],
        [
            "regexp"  => "\\^",
            "tokenId" => Token::RAISED
        ],
        [
            "regexp"  => "\\(",
            "tokenId" => Token::OPEN_BRACKET
        ],
        [
            "regexp"  => "\\)",
            "tokenId" => Token::CLOSE_BRACKET
        ],
        [
            "regexp"  => "(?:\\d+\\.?|\\.\\d)\\d*(?:[Ee][-+]?\\d+)?",
            "tokenId" => Token::NUMBER
        ],
        [
            "regexp"  => "[a-zA-Z]\\w*",
            "tokenId" => Token::VARIABLE
        ]
    ];

    /** @var array all tokens in expression */
    private $tokens;

    /**
     * @param $expression string
     *
     * @return Token[]
     * @throws InvalidTokenException
     */
    public function tokenize($expression)
    {
        $expression = str_replace(' ', '', $expression);
        $this->tokens = [];

        while ($expression != "") {
            $match = false;
            foreach (self::$possibleTokens as $tokenInfo) {
                $regexp = "/^(".$tokenInfo["regexp"].")/";
                $find = preg_match($regexp, $expression, $matches);
                if ($find) {
                    $match = true;
                    $tok = $matches[0];
                    $expression = preg_replace($regexp, "", $expression);
                    $token = new Token($tokenInfo["tokenId"], $tok);
                    array_push($this->tokens, $token);
                    break;
                }
            }
            if (!$match) {
                throw new InvalidTokenException("Unexpected character in input: "
                                                .$expression);
            }
        }

        return $this->tokens;
    }

    public function getTokens()
    {
        return $this->tokens;
    }
}