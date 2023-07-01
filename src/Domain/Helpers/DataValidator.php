<?php

namespace OrderManager\Domain\Helpers;

Trait DataValidator
{
  private function throwExceptionIfStringValueGreaterThan(
    string $value, 
    int $maxLength, 
    string $exceptionMessage)
  {
    $numberOfLetters = strlen($value);

    if($numberOfLetters > $maxLength){
      throw new \DomainException($exceptionMessage);
    }
  }

  protected function throwExceptionIfStringValueLessThan(
    string $value, 
    int $minLength, 
    string $exceptionMessage)
  {
    $numberOfLetters = strlen($value);

    if($numberOfLetters < $minLength){
      throw new \DomainException($exceptionMessage);
    }
  }

  private function throwExceptionIfLengthValueNotEqualTo(
    string $value, 
    int $lenght, 
    string $exceptionMessage)
  {
    $numberOfLetters = strlen($value);

    if($numberOfLetters !== $lenght){
      throw new \DomainException($exceptionMessage);
    }
  }
  
  private function merge(mixed $value, string $exceptionMessage)
  {
    if(empty($value)){
      throw new \DomainException($exceptionMessage);
    }
  }

  private function throwExceptionIfValueLessThan(float $value, float $lessThan, string $exceptionMessage)
  {
    if($value < $lessThan){
      throw new \DomainException($exceptionMessage);
    }
  }
} 