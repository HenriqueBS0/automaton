<?php

namespace HenriqueBS0\Automaton;

class Automaton {
    private array $alphabet;
    private array $states;
    private string $initialState;
    private array $finalStates;
    private array $transitions;

    public function __construct(array $alphabet, array $states, string $initialState, array $finalStates, array $transitions)
    {
        $this->setAlphabet($alphabet);
        $this->setStates($states);
        $this->setInitialState($initialState);
        $this->setFinalStates($finalStates);
        $this->setTransitions($transitions);
    }

    private function getAlphabet() : array
    {
        return $this->alphabet;
    }

    private function setAlphabet(array $alphabet) : void
    {
        $this->alphabet = $alphabet;
    }

    
    private function getStates() : array
    {
        return $this->states;
    }
 
    private function setStates(array $states) : void
    {
        $this->states = $states;
    }


    private function getInitialState() : string
    {
        return $this->initialState;
    }

    private function setInitialState(string $initialState) : void
    {
        if(!in_array($initialState, $this->getStates())) {
            throw AutomatonException::unexpectedInitialState($initialState);
        }

        $this->initialState = $initialState;
    }

    private function getFinalStates() : array
    {
        return $this->finalStates;
    }

    private function setFinalStates(array $finalStates) : void
    {
        foreach($finalStates as $finalState) {
            if(!in_array($finalState, $this->getStates())) {
                throw AutomatonException::unexpectedFinalState($finalState);
            }
        }

        $this->finalStates = $finalStates;
    }
 
    private function getTransitions() : array
    {
        return $this->transitions;
    }

    private function setTransitions(array $transitions)
    {
        foreach ($transitions as $currentState => $transitionsState) {
            foreach ($transitionsState as $input => $nextState) {
                $transitionFunction = "'{$nextState} = δ({$currentState}, {$input})'";

                if(!in_array($currentState, $this->getStates())) {
                    throw AutomatonException::invalidTranstionUnexpectedCurrentState($transitionFunction, $currentState);
                }

                if(!in_array($input, $this->getAlphabet())) {
                    throw AutomatonException::invalidTranstionUnexpectedInput($transitionFunction, $input);
                }   

                if(!in_array($nextState, $this->getStates())) {
                    throw AutomatonException::invalidTranstionUnexpectedNextState($transitionFunction, $nextState);
                }
            }
        }

        $this->transitions = $transitions;
    }

    public function getFinalState(string $input) : string 
    {
        $characters = str_split($input);

        foreach ($characters as $character) {
            if(!in_array($character, $this->getAlphabet())) {
                throw AutomatonException::unexpectedInputCharacter($character);
            }
        }

        $state = $this->getInitialState();

        foreach ($characters as $character) {
            if(!isset($this->getTransitions()[$state][$character])) {
                throw AutomatonException::unexpectedTransition("δ({$state}, {$character})");
            }

            $state = $this->getTransitions()[$state][$character];
        }

        if(!in_array($state, $this->getFinalStates())) {
            $state = $this->getTransitions()[$state][''];
        }


        if(!in_array($state, $this->getFinalStates())) {
            throw AutomatonException::lastStateIsNoteFinal($state);
        }

        return $state;
    }
}