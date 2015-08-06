<?php

namespace ExpressionParser;

use ExpressionParser\Tokens\Token;
use ExpressionParser\ExpressionElements\Constant;
use ExpressionParser\ExpressionElements\Variable;
use ExpressionParser\ExpressionElements\OperatorsFactory;
use ExpressionParser\ExpressionElements\OperatorInterface;

class ShuntingYard
{
    /**
     * @param Token[] $tokens
     *
     * @return array
     * @throws ExpressionParserException
     */
    public function shuntingYard($tokens)
    {
        $stack = new \SplStack();
        $output = new \SplQueue();

        foreach ($tokens as $token) {
            if ($token->getTokenId() == Token::NUMBER) {
                $output->enqueue(new Constant($token->getValue()));
            }
            elseif ($token->getTokenId() == Token::VARIABLE) {
                $output->enqueue(new Variable($token->getValue()));
            }
            elseif ($this->isOperator($token)) {
                $operator1 = OperatorsFactory::create($token->getTokenId());
                while (
                    $this->topStackIsOperator($stack)
                    && ($operator2 = $stack->top())
                    && $this->hasLowerPrecedence($operator1, $operator2)
                ) {
                    $output->enqueue($stack->pop());
                }

                $stack->push($operator1);
            } elseif ($token->getTokenId() == Token::OPEN_BRACKET) {
                $stack->push(
                    new ExpressionElements\Bracket(Token::OPEN_BRACKET)
                );
            } elseif ($token->getTokenId() == Token::CLOSE_BRACKET) {
                while ($this->stackTopIsNotOpenBracket($stack)) {
                    $output->enqueue($stack->pop());
                }

                if (count($stack) === 0) {
                    throw new ExpressionParserException("Mismatched parenthesis");
                }

                $stack->pop();
            } else {
                throw new ExpressionParserException("Invalid token: "
                                                    .$token->getValue());
            }
        }

        while ($this->topStackIsOperator($stack)) {
            $output->enqueue($stack->pop());
        }

        if (count($stack) > 0) {
            throw new ExpressionParserException('Mismatched parenthesis or misplaced number in input');
        }

        return iterator_to_array($output);
    }

    private function topStackIsOperator(\SplStack $stack)
    {
        return (
            count($stack) > 0
            && $stack->top()->getExpressionType()
               == ExpressionElements\ExpressionElementInterface::OPERATOR
        );
    }

    /**
     * @param $operator1 /ExpressionElement/OperatorInterface
     * @param $operator2 /ExpressionElement/OperatorInterface
     *
     * @return bool
     */
    private function hasLowerPrecedence(
        OperatorInterface $operator1, OperatorInterface $operator2
    ) {
        return ($operator1->getAssociative() == 'left'
                && $operator1->getPrecedence() == $operator2->getPrecedence())
               || $operator1->getPrecedence() < $operator2->getPrecedence();
    }

    private function stackTopIsNotOpenBracket(\SplStack $stack)
    {
        return (
            count($stack) > 0
            && ($stack->top()->getExpressionType()
                != ExpressionElements\ExpressionElementInterface::BRACKET
                || $stack->top()->getBracketType() == Token::CLOSE_BRACKET)
        );
    }

    private function isOperator(Token $token)
    {
        $result = in_array($token->getTokenId(), ExpressionParser::$operators);
        return $result;
    }
}