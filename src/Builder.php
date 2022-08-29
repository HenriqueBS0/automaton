<?php

namespace HenriqueBS0\Automaton;

class Builder {

    public static function getTransitions(array $statesInputs) : array 
    {
        $transitions = [];

        foreach($statesInputs as $state => $inputs) {
            foreach ($inputs as $input) {
                $transitions[strval($input)] = $state;
            }
        }

        return $transitions;
    }

    public static function getInputsToState(string $state, array $inputs) : array
    {
        $transitions = [];

        foreach ($inputs as $input) {
            $transitions[strval($input)] = $state;
        }

        return $transitions;
    }

    public static function getInputs(array $inputs, array $removeInputs = []) : array 
    {
        $uniqueArrayInputs = [];

        foreach ($inputs as $input) {
            if(is_array($input)) {
                $uniqueArrayInputs = array_merge($uniqueArrayInputs, self::getInputs($input));
            }
            else {
                $uniqueArrayInputs[] = strval($input);
            }
        }

        $uniqueArrayInputs = array_diff($uniqueArrayInputs, $removeInputs);

        return $uniqueArrayInputs;
    }

    public static function getLetters() : array 
    {
        return array_merge(self::getSmallLetters(), self::getCapitalLetters());
    }

    public static function getCapitalLetters() : array 
    {
        return array_map(function($letter) {return strtoupper($letter);}, self::getSmallLetters());
    }

    public static function getSmallLetters() : array 
    {
        return [
            'a', 'b', 'c', 'd', 'e',
            'f', 'g', 'h', 'i', 'j',
            'k', 'l', 'm', 'n', 'o',
            'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y',
            'z'
        ];
    }

    public static function getNumbers() : array
    {
        return [
            '1', '2', '3', '4', '5', 
            '6', '7', '8', '9', '0'
        ];    
    }
}