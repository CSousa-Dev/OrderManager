<?php

namespace OrderManager\Domain\Customer;

class Customer 
{
  private string $name;

  public function __construct(string $name)
  {
    $this->validateName($name);
    $this->name = $name;
  }

  private function validateName(string $name)
  {
    $this->checkIfNameIsEmpty($name);
    $this->checkIfLastNameIsMissing($name);
    $this->checkIfNameIsTooShort($name);
    $this->checkIfNameIsTooLong($name);
  }

  private function checkIfNameIsEmpty(string $name)
  {
    if(empty($name)){
      throw new \DomainException('É necessário informar nome e sobrenome para um cliente.');
    }
  }

  private function checkIfLastNameIsMissing(string $name)
  {
    $numberOfWords = count(explode(' ', $name));
    if($numberOfWords < 2)
    {
      throw new \DomainException('É necessário informar nome e sobrenome para um cliente.');
    }
  }

  private function checkIfNameIsTooShort(string $name)
  {
    $numberOfLetters = strlen($name);
    if($numberOfLetters < 8)
    {
      throw new \DomainException('O nome informado é muito curto!');
    }
  }

  private function checkIfNameIsTooLong(string $name)
  {
    $numberOfLetters = strlen($name);
    if($numberOfLetters > 55)
    {
      throw new \DomainException('O nome informado é muito longo!');
    }
  }

  public function name()
  {
    return $this->name;
  }
}