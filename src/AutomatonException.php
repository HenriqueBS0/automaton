<?php

namespace HenriqueBS0\Automaton;

use Exception;

class AutomatonException extends Exception {

    const CODE_UNEXPECTED_INITIAL_STATE = 1;
    const CODE_UNEXPECTED_FINAL_STATE   = 2;

    const CODE_INVALID_TRASITION_UNEXPECTED_CURRENT_STATE = 3;
    const CODE_INVALID_TRASITION_UNEXPECTED_INPUT         = 4;
    const CODE_INVALID_TRASITION_UNEXPECTED_NEXT_STATE    = 5;

    const CODE_UNEXPECTED_INPUT_CHARACTER = 6;
    const CODE_UNEXPECTED_TRANSACTION     = 7;
    const CODE_LAST_STATE_IS_NOT_FINAL    = 8;

    public static function unexpectedInitialState(string $state) : self 
    {
        return new self("The initial state '{$state}' does not belong to the states reported.", self::CODE_UNEXPECTED_INITIAL_STATE);
    }

    public static function unexpectedFinalState(string $state) : self 
    {
        return new self("The final state '{$state}' does not belong to the states reported.", self::CODE_UNEXPECTED_FINAL_STATE);
    }

    public static function invalidTranstionUnexpectedCurrentState(string $trasitionFunction, string $state) : self 
    {
        return new self("Invalid transition function '{$trasitionFunction}', the current state '{$state}' does not belong to the reported states.", self::CODE_INVALID_TRASITION_UNEXPECTED_CURRENT_STATE);
    }

    public static function invalidTranstionUnexpectedInput(string $trasitionFunction, string $input) : self 
    {
        return new self("Invalid transition function '{$trasitionFunction}', the input '{$input}' does not belong to the reported alphabet.", self::CODE_INVALID_TRASITION_UNEXPECTED_INPUT);
    }

    public static function invalidTranstionUnexpectedNextState(string $trasitionFunction, string $state) : self 
    {
        return new self("Invalid transition function '{$trasitionFunction}', the next state '{$state}' does not belong to the reported states.", self::CODE_INVALID_TRASITION_UNEXPECTED_NEXT_STATE);
    }

    public static function unexpectedInputCharacter(string $character) : self
    {
        return new self("The input character '{$character}' does not belong to the given alphabet.", self::CODE_UNEXPECTED_INPUT_CHARACTER);
    }

    public static function unexpectedTransition(string $transition) : self 
    {
        return new self("The transition function '{$transition}' not anticipated", self::CODE_UNEXPECTED_TRANSACTION);
    }

    public static function lastStateIsNoteFinal(string $state) : self
    {
        return new self("The last state found '{$state}' is not final", self::CODE_LAST_STATE_IS_NOT_FINAL);
    }
}